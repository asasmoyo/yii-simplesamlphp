<?php

/**
 * Use this action to login a user.
 */
class LoginSSOAction extends CAction {

    /**
     * The component name which is you register Simplesamlphp instance in your config/main.php.
     */
    public $simplesamlphpComponentName = 'simplesamlphp';

    /**
     * Where the user is redirected after logout.
     */
    public $redirectAfterLoginTo = array('/');

    /**
     * Simplesamlphp component instance.
     */
    private $simplesamlphpInstance = null;

    /**
     * Init LoginSSOAction.
     */
    public function init() {
        $componentName = $this->simplesamlphpComponentName;
        $this->simplesamlphpInstance = Yii::app()->$componentName;

        parent::init();
    }

    /**
     * Run the login action. The user will be redirected to Simplesamlphp IdP login page, if he successfully login then he will be redirected to this page again. After that login the user to Yii application and then redirect the user to $redirectAfterLoginTo route.
     */
    public function run() {
        $this->setRootPathOfAlias();
        $this->loadRequiredClass();

        $this->simplesamlphpInstance()->requireAuth();
        $userIdentity = new SSOUserIdentity($this->simplesamlphpInstance()->username, '');
        Yii::app()->user->login($userIdentity);

        $this->getController()->redirect($this->redirectAfterLoginTo);
    }

    private function setRootPathOfAlias() {
        if (Yii::getPathOfAlias('yii-simplesamlphp') === false) {
            Yii::setPathOfAlias('yii-simplesamlphp', realpath(dirname(__FILE__) . '/..'));
        }
    }

    private function loadRequiredClass() {
        Yii::import('yii-simplesamlphp.components.SSOUserIdentity');
    }

}
