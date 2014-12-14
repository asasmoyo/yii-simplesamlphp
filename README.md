Yii Simplesamlphp
-----------------

###1. Installation

  Download or clone this repot then extract to `extensions`. Register `components/Simplesaml.php` as a component. It needs 2 arguments, `autoloadPath` where your simplesamlphp sp's `lib/_autoload.php` is and `authSource` the authentication source that you will use on your `config/authsources.php`

  ```php
  // on config/main.php
  'components' => array(
  	  'simplesamlphp' => array(
	        'class' => 'ext.yii-simplesamlphp.components.Simplesamlphp',
	        'autoloadPath' => 'SIMPLESAMLPHP_SP_PATH/lib/_autoload.php',
	        'authSource' => 'default-sp',
	    ),
	   
       //your other components
  ),
  ```

###2. Usage

  - Using [simplesamlphp sp's api](https://simplesamlphp.org/docs/stable/simplesamlphp-sp-api)  

  Now you can use the api simply by call `Yii::app()->componentName->method_name()`.

  - Login and logout action  
  
  You can use our `LoginAction` and `LogoutAction` to login and logout your application with Simplesamlphp. All you need to do is create method `actions` on your controller and add `LoginAction` and `LogoutAction`.

  ```php
  // on your controller
  class SiteController extends Controller {

      public function actions() {
          return array(
		          'login' => array(
		              'class' => 'ext.yii-simplesamlphp.actions.LoginSSOAction',
		              'simplesamlphpComponentName' => 'simplesamlphp',
		              'redirectAfterLoginTo' => array('/'),
		          ),
		          'logout' => array(
		              'class' => 'ext.yii-simplesamlphp.actions.LogoutSSOAction',
		              'simplesamlphpComponentName' => 'simplesamlphp',
		              'redirectAfterLogoutTo' => array('/'),
		          ),
	        );
      }

      //your other actions

  }
  ```

  Now you can login via `site/login` and logout via `site/logout`.
  You need to specify `simplesamlphpComponentName` with your component name which you register `components/Simplesamlphp.php` and `redirectAfterLogin` and `redirectAfterLogout` with a route where you want to be redirected after login / logout.

###3. Example

  You can install [Yii Simplesamlphp Example](https://github.com/asasmoyo/yii-simplesamlphp) to try this extension.