<?php

/**
 * Description of LogoutSSOAction
 *
 * @author Arba
 */
class LogoutSSOAction extends CAction {

    public $simplesamlphpComponentName = '';
    public $redirectAfterLoginTo = '';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->checkProperty();
        $this->setRootPathOfAlias();

        if ($this->getSimplesamlphpInstance()->isAuthenticated()) {
            $this->getSimplesamlphpInstance()->logout();
        }
        Yii::app()->user->logout(true);

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

}
