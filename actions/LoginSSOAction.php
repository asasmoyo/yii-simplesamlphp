<?php

/**
 * Description of LoginSSOAction
 *
 * @author Arba
 */
class LoginSSOAction extends CAction {

    public $simplesamlphpComponentName = '';
    public $redirectAfterLoginTo = '';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->checkProperty();
        $this->setRootPathOfAlias();
        $this->loadRequiredClass();

        $this->getSimplesamlphpInstance()->requireAuth();
        $userIdentity = new SSOUserIdentity($this->getSimplesamlphpInstance()->email_address[0], '');
        Yii::app()->user->login($userIdentity);

        $this->getController()->redirect($this->redirectAfterLoginTo);
    }

    public function checkProperty() {
        if ($this->simplesamlphpComponentName == '')
            throw new Exception('simplesamlphpComponentName belum diset');

        if ($this->redirectAfterLoginTo == '')
            throw new Exception('redirectAfterLoginTo belum diset');
    }

    private function getSimplesamlphpInstance() {
        $temp = $this->simplesamlphpComponentName;
        return Yii::app()->$temp;
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
