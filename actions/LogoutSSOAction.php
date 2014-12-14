<?php

/**
 * Use this action to logout a user.
 */
class LogoutSSOAction extends CAction {

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
     * Init LogoutSSOAction.
     */
    public function init() {
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
