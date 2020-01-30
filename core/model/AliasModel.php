<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * AliasModel Class.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.4 30.01.2020
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019 - 2020, OCMS
 */
class AliasModel {

	/**
	 * @return array
	 */
	public static function getAliases (): array {

		return Kernel::$modelObj->fetch ('SELECT * FROM /*prefix*/alias');
	}
}
