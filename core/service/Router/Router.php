<?php

namespace Ocms\core\service\Router;

use Ocms\core\exception\ExceptionRuntime;

/**
 * Description of Router
 *
 * @author olegiv
 */
class Router implements RouterInterface {
	
	const DEFAULT_CONTROLLER = 'FrontController';
	const DEFAULT_ACTION = 'viewAction';
	
	const CONTROLLER_CLASS_PREFIX = 'Ocms\core\controller\\';

	/**
	 *
	 * @var Ocms\core\service\Router\Router This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var string
	 */
	private $controllerClass;
	
	/**
	 *
	 * @var string
	 */
	private $controllerMethod;
	
	/**
	 *
	 * @var string
	 */
	private $parameter;


	/**
	 * 
	 * @return Ocms\core\service\Router\Router
	 */
  public static function getInstance(): Router {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {}

	/**
	 * 
	 */
	public function run () {

		try {
			if ($this->setController()) {
				call_user_func ($this->controllerClass . '::' . $this->controllerMethod, $this->parameter);
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
	
	/**
	 * 
	 * @return bool
	 */
	private function setController (): bool {
		
		$this->getControllerFromRequest();
		return $this->validateController($this->controllerClass, $this->controllerMethod);
	}
	
	/**
	 * 
	 */
	private function getControllerFromRequest (){
		
		$request = getenv ('REQUEST_URI');
		$parts = explode('?', $request);
    $splits = explode('/', trim($parts[0],'/'));

    $this->controllerClass = !empty($splits[0]) ? ucfirst($splits[0]).'Controller' : self::DEFAULT_CONTROLLER;
		$this->controllerClass = self::CONTROLLER_CLASS_PREFIX . $this->controllerClass;
    $this->controllerMethod = !empty($splits[1]) ? $splits[1].'Action' : self::DEFAULT_ACTION;
		
    if (isset($splits[2]) && !empty(trim ($splits[2]))){
      $this->parameter = trim($splits[2]);
		} else {
			$this->parameter = 0; // @todo
		}
	}
	
	/**
	 * 
	 * @param string $controller
	 * @return bool
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	private function validateController (string $controller, string $method): bool {
		
		$return = TRUE;
		try {
			if (class_exists ($controller)) {
				$rc = new \ReflectionClass($controller);
				if ($rc->implementsInterface (self::CONTROLLER_CLASS_PREFIX . 'ControllerInterface')) {
					if(! $rc->hasMethod ($method)) {
						throw new ExceptionRuntime (ExceptionRuntime::E_METHOD_NOT_ALLOWED,
							t('Controller %s does not have method %s', $controller, $method));
					}
				} else {
					throw new ExceptionRuntime (ExceptionRuntime::E_METHOD_NOT_ALLOWED,
						t('Controller %s does not implement ControllerInterface', $controller));
				}
			} else {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND,
					t('Controller %s does not exists', $controller));
			}
		} catch (ExceptionRuntime $e) {
			$return = FALSE;
		}
		return $return;
	}

	/**
	 * 
	 * @return array
	 */
	/*public function getParams (): array {
		
		return [];
	}*/
	
	/**
	 * 
	 * @param string $key
	 * @return string
	 */
	/*public function getParam (string $key): string {
		
		$param = '';
		if (($params = $this->getParams())) {
			if (array_key_exists ($key, $params)) {
				$param = $params[$key];
			}
		}
		return $param;
	}*/

}
