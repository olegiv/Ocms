<?php

namespace Ocms\core\controller;

/**
 * ControllerBaseInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 01.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface ControllerBaseInterface {

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId);

	/**
	 * @param string $controller
	 * @param string $method
	 * @return bool
	 * @throws \ReflectionException
	 */
	public static function validateController (string $controller, string $method): bool;
}
