<?php

namespace Ocms\core\service\Router;

use Ocms\core\controller\ControllerBase;
use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;

/**
 * Router Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.8 30.01.2020
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2020, OCMS
 */
class Router implements RouterInterface {

	const DEFAULT_CONTROLLER = 'FrontController';
	const DEFAULT_ACTION = 'viewAction';

	/**
	 *
	 * @var Router This class instance
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
	 * @var array
	 */
	private static $routes = [];

	/**
	 * @return Router
	 */
	public static function getInstance(): Router {

	  	if(! (self::$_instance instanceof self)) {
			self::$_instance = new self();
  		}
		self::load ();
    	return self::$_instance;
  	}

	/**
	 *
	 */
	private function __construct() {}

	/**
	 *
	 */
	private static function load () {

		// 1. Load aliased from DB
		$routesDB = Kernel::$aliasObj->getAliases();

		// 2. Load routes from static configuration
		$routesConfig = Kernel::$configurationObj->getRoutesGlobal ();

		self::$routes = array_merge ($routesDB, $routesConfig);
	}

	/**
	 *
	 */
	public function run () {

		if ($this->setController()) {
			$controllerWithMethod = $this->controllerClass . '::' . $this->controllerMethod;
			if (Kernel::inDebug()) {
				echo NEW_LINE . '<!-- Controller begin: ' . $controllerWithMethod . ' -->' . NEW_LINE;
			}
			call_user_func ($controllerWithMethod, $this->parameter);
			if (Kernel::inDebug()) {
				echo NEW_LINE . '<!-- Controller end: ' . $controllerWithMethod . '-->' . NEW_LINE;
			}
		}
	}

	/**
	 * @return bool
	 */
	private function setController (): bool {

		$this->getControllerFromRequest();
		return ControllerBase::validateController($this->controllerClass, $this->controllerMethod);
	}

	/**
	 *
	 */
	private function getControllerFromRequest() {

		$request = getenv ('REQUEST_URI');
		$parts = explode('?', $request);

		try {

			if ('/' === $parts[0]) {

				$nodeId = Kernel::$configurationObj->getHomePageId();
				$this->setClassForNode($nodeId);

			} else if (($nodeId = $this->getNodeId($parts[0]))) {

				$this->setClassForNode($nodeId);

			} else if (($controller = $this->getController($parts[0]))) {

				if (false === strpos($controller, '::')) {
					throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Controller path should contain "::": %s', $controller));
				}

				list ($class, $method) = explode('::', $controller);
				if (isset ($class) && isset ($method)) {
					$this->controllerClass = $class;
					$this->controllerMethod = $method;
				} else {
					if (Kernel::inDebug()) {
						throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Controller not found: %s', $controller));
					} else {
						throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Page not found: %s', $request));
					}
				}

			} else {

				$splits = explode('/', trim($parts[0], '/'));

				$this->controllerClass = !empty($splits[0]) ? ucfirst($splits[0]) . 'Controller' : self::DEFAULT_CONTROLLER;
				$this->controllerClass = ControllerBase::CONTROLLER_CLASS_PREFIX . $this->controllerClass;
				$this->controllerMethod = !empty($splits[1]) ? $splits[1] . 'Action' : self::DEFAULT_ACTION;

				if (isset($splits[2]) && !empty(trim($splits[2]))) {
					$this->parameter = trim($splits[2]);
				} else {
					$this->parameter = 0; // @todo
				}
			}
		} catch (ExceptionRuntime $e) {

		}
	}

	/**
	 * @param string $alias
	 * @return int
	 */
	private function getNodeId(string $alias): int {

		$return = 0;

		if (self::$routes) {
			foreach (self::$routes as $route) {
				if ($route->alias === $alias) {
					$return = (int)$route->node;
					break;
				}
			}
		}

		return $return;
	}

	/**
	 * @param string $alias
	 * @return string
	 */
	private function getController(string $alias): string {

		$return = '';

		if (self::$routes) {
			foreach (self::$routes as $route) {
				if ($route->alias === $alias) {
					$return = $route->controller;
					break;
				}
			}
		}

		return $return;
	}

	/**
	 * @param int $nodeId
	 */
	private function setClassForNode(int $nodeId) {

		if (Kernel::$configurationObj->getHomePageId() === $nodeId) {
			$this->controllerClass = 'Ocms\core\controller\FrontController';
		} else {
			$this->controllerClass = 'Ocms\core\controller\NodeController';
		}
		$this->controllerMethod = self::DEFAULT_ACTION;
		$this->parameter = $nodeId;
	}
}
