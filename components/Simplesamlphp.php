<?php

class Simplesamlphp extends CApplicationComponent {

    public $autoloadPath;
    public $authSource;
    private $authSimple;
    private $attributes;
    private static $data;

    public function init() {
        $this->loadSimplesamlPhp();
        $this->authSimple = new \SimpleSAML_Auth_Simple($this->authSource);
        $this->attributes = $this->authSimple->getAttributes();

        parent::init();
    }

    public function loadSimplesamlPhp() {
        require_once($this->autoloadPath);
        YiiBase::registerAutoloader('SimpleSAML_autoload', true);
    }

    public function requireAuth() {
        $this->authSimple->requireAuth();
    }

    public function login(array $params = array()) {
        $this->authSimple->login($params);
    }

    public function logout() {
        $this->authSimple->logout();
    }

    public function getLoginURL($returnTo = null) {
        $this->authSimple->getLogoutUrl($returnTo);
    }

    public function getLogoutURL($returnTo = null) {
        $this->authSimple->getLogoutUrl($returnTo);
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function isAuthenticated() {
        return $this->authSimple->isAuthenticated();
    }

    public function __get($name) {
        return $this->getData($name);
    }

    private function getData($name) {
        if (!self::$data) {
            self::$data = json_decode($this->attributes['data'][0]);
        }

        return self::$data->$name;
    }

}
