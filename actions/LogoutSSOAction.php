<?php

/**
 * Description of LogoutSSOAction
 *
 * @author Arba
 */
class LogoutSSOAction extends CAction {

    public $simplesamlphpComponentName = '';
    public $redirectAfterLogoutTo = '';

    public function init() {
        parent::init();
    }

    public function run() {
        $this->setRootPathOfAlias();

        if ($this->getSimplesamlphpInstance()->isAuthenticated()) {
            $this->getSimplesamlphpInstance()->logout();
        }
        Yii::app()->user->logout(true);

        $this->getController()->redirect($this->redirectAfterLogoutTo);
    }

    private function setRootPathOfAlias() {
        if (Yii::getPathOfAlias('yii-simplesamlphp') === false) {
            Yii::setPathOfAlias('yii-simplesamlphp', realpath(dirname(__FILE__) . '/..'));
        }
    }

    private function getSimplesamlphpInstance() {
        $temp = $this->simplesamlphpComponentName;
        return Yii::app()->$temp;
    }

}
