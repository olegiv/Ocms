<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * AliasModel Class.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.2 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class AliasModel {

	/**
	 * @param string $alias
	 * @return int
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getNode(string $alias): int {

		return (int)Kernel::$modelObj->shift('SELECT node FROM /*prefix*/alias WHERE alias=?', $alias);
	}

	/**
	 * @param string $alias
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getController (string $alias): string {

		return (string)Kernel::$modelObj->shift('SELECT controller FROM /*prefix*/alias WHERE alias=?', $alias);
	}

	/**
	 * @return array
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getAliases (): array {

		return Kernel::$modelObj->fetch ('SELECT * FROM /*prefix*/alias');
	}
}
