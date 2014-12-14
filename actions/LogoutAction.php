<?php

/**
 * Use this action to logout a user.
 */
class LogoutAction extends CAction {

    /**
     * The component name which is you register Simplesamlphp instance in your config/main.php.
     */
    public $simplesamlphpComponentName = 'simplesamlphp';

    /**
     * Where the user is redirected after logout.
     */
    public $redirectAfterLogoutTo = array('/');

    /**
     * Simplesamlphp component instance.
     */
    private $simplesamlphpInstance = null;

    /**
     * Init LogoutAction.
     */
    public function init() {
        assert(!is_null($this->simplesamlphpComponentName), 'You must set simplesamlphp component name.');
        assert(!empty($this->redirectAfterLogoutTo), 'You must set redirect after logout to.');

        $componentName = $this->simplesamlphpComponentName;
        $this->simplesamlphpInstance = Yii::app()->$componentName;
    }

    /**
     * Run the logout action. Logout the user's session in Simplesamlphp Sp then redirected back to this action then logout the user's sesion in Yii application and then redirect the user to $redirectAfterLogoutTo.
     */
    public function run() {
        $this->init();

        if ($this->simplesamlphpInstance->isAuthenticated()) {
            $this->simplesamlphpInstance->logout();
        }
        Yii::app()->user->logout(true);

        $this->getController()->redirect($this->redirectAfterLogoutTo);
    }

}
