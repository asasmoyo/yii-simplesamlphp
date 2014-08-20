<?php

class SSOWebUser extends CWebUser {

    public $simplesamlphpComponentName = '';

    public function init() {
        parent::init();
    }

    private function checkProperties() {
        if ($this->simplesamlphpComponentName == '') {
            throw new Exception('simplesamlphpComponentName belum di set.');
        }
    }

    private function getSimplesamlphpInstance() {
        $this->checkProperties();
        $temp = $this->simplesamlphpComponentName;
        return Yii::app()->$temp;
    }

    public function getId() {
        return $this->getSimplesamlphpInstance()->email_address;
    }

    public function getName() {
        return $this->getSimplesamlphpInstance()->email_address;
    }

    public function getIsGuest() {
        return !$this->getSimplesamlphpInstance()->isAuthenticated();
    }

}
