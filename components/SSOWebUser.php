<?php

/**
 * This class represents user with Simplesamlphp backend. It overrides a few of WebUser default behaviour with Simplesamlphp behaviour.
 */
class SSOWebUser extends CWebUser {

    /**
     * The component name which is you register Simplesamlphp instance in your config/main.php.
     */
    public $simplesamlphpComponentName = 'simplesamlphp';

    /**
     * Simplesamlphp component instance.
     */
    private $simplesamlphpInstance = null;

    /**
     * Init the SSOWebUser.
     */
    public function init() {
        $componentName = $this->simplesamlphpComponentName;
        $this->simplesamlphpInstance = Yii::app()->$componentName;

        parent::init();
    }

    /**
     * @see http://www.yiiframework.com/doc/api/1.1/CWebUser#getId-detail
     */
    public function getId() {
        return $this->simplesamlphpInstance->username;
    }

    /**
     * @see http://www.yiiframework.com/doc/api/1.1/CWebUser#getName-detail
     */
    public function getName() {
        return $this->simplesamlphpInstance->username;
    }

    /**
     * @see http://www.yiiframework.com/doc/api/1.1/CWebUser#getIsGuest-detail
     */
    public function getIsGuest() {
        return !$this->simplesamlphpInstance->isAuthenticated();
    }

}
