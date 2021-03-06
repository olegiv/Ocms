<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * MenuModel Class.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.4 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MenuModel {

	/**
	 * @param int $nodeId
	 * @return array
	 * @todo Returns generic menu now
	 */
	public static function getMenuForNode(int $nodeId): array {

		return Kernel::$modelObj->fetch('SELECT * FROM /*prefix*/menu ORDER BY ranking');
	}
}
