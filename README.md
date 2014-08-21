yii-simplesamlphp
-----------------

###1. Installation
- Register `components/Simplesaml.php` as a component. It needs 2 arguments, `autoloadPath` where your simplesamlphp sp's `lib/_autoloadphp` is and `authSource` the authentication source that you will use on your `config/authsources.php`
```php
'simplesamlphp' => array(
    'class' => 'ext.yii-simplesamlphp.components.Simplesamlphp',
    'autoloadPath' => '../lib/_autoload.php',
    'authSource' => 'default-sp',
),
```
###2. Usage
##1. Using (simplesamlphp sp's api)[https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api]
Now you can use the api simply by call `Yii::app()->simplesamlphp->method_name()`
##2. Login and logout action
You can use our LoginSSOAction and LogoutSSOAction to login and logout your application with Simplesamlphp. All you need to do is create method `actions` on your controller and add LoginSSOAction and LogoutSSOAction to your action.
```php
'login' => array(
    'class' => 'ext.yii-simplesamlphp.actions.LoginSSOAction',
    'simplesamlphpComponentName' => 'simplesamlphp',
    'redirectAfterLoginTo' => '/',
),
'logout' => array(
    'class' => 'ext.yii-simplesamlphp.actions.LogoutSSOAction',
    'simplesamlphpComponentName' => 'simplesamlphp',
    'redirectAfterLogoutTo' => '/',
),
```
You need to specify `simplesamlphpComponentName` with your component name which you register `components/Simplesamlphp.php` and `redirectAfterLogin` and `redirectAfterLogour` with a route where you want to be redirected after login / logout.
