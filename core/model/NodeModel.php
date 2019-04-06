<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * NodeModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.4 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class NodeModel {

	/**
	 * @param int $nodeId
	 * @return object
	 */
	public static function getNode (int $nodeId) {
		
		return Kernel::$modelObj->single('SELECT * FROM /*prefix*/node WHERE id=?', $nodeId);
	}
}
