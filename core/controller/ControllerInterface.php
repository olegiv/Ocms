<?php

namespace Ocms\core\controller;

/**
 * ControllerInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface ControllerInterface extends ControllerBaseInterface {

  /**
   * @param int $nodeId
   * @return mixed
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
