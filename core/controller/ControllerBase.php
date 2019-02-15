<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;

/**
 * ControllerBase Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 15.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
abstract class ControllerBase implements ControllerBaseInterface {

	const CONTROLLER_CLASS_PREFIX = 'Ocms\core\controller\\';

	/**
	 *
	 * @var int
	 */
	protected $nodeId;

	/**
	 *
	 * @var
	 */
	protected $node;

	/**
	 *
	 */
	protected function getConfig () {}

	/**
	 * @param array $properties
	 * @return string
	 */
	public static function run (array $properties): string {}

  /**
   * @param int $nodeId
   */
	public static function viewAction (int $nodeId) {}

	/**
	 * @param string $data
	 */
	public static function view (string $data) {}

	/**
	 * @param string $controllerWithMethod
	 * @return bool
	 * @throws \Exception
	 */
	public static function validateControllerWithMethod (string $controllerWithMethod): bool {

		$return = true;
		list($controller, $method) = explode('::', $controllerWithMethod);
		try {
			if (! $controller) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND,	t('Controller is empty'));
			} else if (! $method) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND,	t('Method is empty'));
			}
			$return = self::validateController($controller,$method);
		} catch (ExceptionRuntime $e) {
			$return = false;
		}
		return $return;
	}

	/**
	 * @param string $controller
	 * @param string $method
	 * @return bool
	 * @throws \ReflectionException
	 */
	public static function validateController (string $controller, string $method): bool {

		$return = TRUE;
		try {
			if (class_exists ($controller)) {
				$rc = new \ReflectionClass($controller);
				if ($rc->implementsInterface (self::CONTROLLER_CLASS_PREFIX . 'ControllerBaseInterface')) {
					if(! $rc->hasMethod ($method)) {
						throw new ExceptionRuntime (ExceptionRuntime::E_METHOD_NOT_ALLOWED,
							t('Controller "%s" does not have method %s', $controller, $method));
					}
				} else {
					throw new ExceptionRuntime (ExceptionRuntime::E_METHOD_NOT_ALLOWED,
						t('Controller "%s" does not implement ControllerBaseInterface', $controller));
				}
			} else {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND,
					t('Controller "%s" does not exist', $controller));
			}
		} catch (ExceptionRuntime $e) {
			$return = FALSE;
		}
		return $return;
	}
}
