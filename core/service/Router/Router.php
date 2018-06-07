<?php

namespace Ocms\core\service\Router;

/**
 * Description of Router
 *
 * @author olegiv
 */
class Router implements RouterInterface {
	
	const DEFAULT_CONTROLLER = 'Ocms\core\controller\FrontController';
	
	const CONTROLLER_GETINSTANCE_METHOD = 'getInstance';

	/**
	 *
	 * @var Router This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return Router
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
	public function init () {

	}

	/**
	 * 
	 */
	public function run () {
		
		try {
			$controller = $this->getController();
			$controllerObj = call_user_func ($controller . '::' . self::CONTROLLER_GETINSTANCE_METHOD);
			$controllerObj->run();
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}
	
	/**
	 * 
	 * @return string
	 */
	private function getController (): string {
		
		if (! ($controller = $this->getControllerFromRequest())) {
			$controller = self::DEFAULT_CONTROLLER;
		}
		$this->validateController($controller);
		return $controller;
	}
	
	/**
	 * 
	 * @return string
	 */
	private function getControllerFromRequest (): string {
		
		return '';
	}
	
	/**
	 * 
	 * @param string $controller
	 * @throws \Exception
	 */
	private function validateController (string $controller) {
		
		if (! class_exists($controller)) {
			throw new \Exception (t('Controller does not exists: ') . $controller);
		}
		if (! method_exists($controller, self::CONTROLLER_GETINSTANCE_METHOD)) {
			throw new \Exception (t('Controller method ') .
							self::CONTROLLER_GETINSTANCE_METHOD . ' does not exists: ' . $controller);
		}
	}

	/**
	 * 
	 * @return array
	 */
	public function getParams (): array {
		
		return [];
	}
	
	/**
	 * 
	 * @param string $key
	 * @return string
	 */
	public function getParam (string $key): string {
		
		$param = '';
		if (($params = $this->getParams())) {
			if (array_key_exists ($key, $params)) {
				$param = $params[$key];
			}
		}
		return $param;
	}

}
