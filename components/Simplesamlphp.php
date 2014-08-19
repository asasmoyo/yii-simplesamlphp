<?php

class Simplesamlphp extends CApplicationComponent {

    public $autoloadPath = '';
    public $authSource = '';
    private $authSimple = null;
    private $attributes = null;

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
        return $this->authSimple->getAttributes();
    }

    public function isAuthenticated() {
        return $this->authSimple->isAuthenticated();
    }

    public function __get($name) {
        return isset($this->getAttributes()[$name]) ? $this->getAttributes()[$name] : null;
    }

}
