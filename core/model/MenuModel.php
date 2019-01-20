<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * MenuModel Class.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.0 18.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MenuModel {

	public static function getMenuForNode(int $nodeId): array {

		$menu = Kernel::$modelObj->fetch('SELECT * FROM #prefix#menu ORDER BY rank');

		if ($menu) {
			foreach ($menu as $key => $value) {
				if ($nodeId == $value->nodeId) {
					$menu[$key]->current = true;
				} else {
					$menu[$key]->current = false;
				}
			}
		} else {
			$menu = [];
		}
		return $menu;
	}
}
