<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * BlockModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.7 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 -2019, OCMS
 */
class BlockModel {

	/**
	 * @param int $blockId
	 * @return object|bool
	 */
	public static function getById (int $blockId) {
		
		return Kernel::$modelObj->single('SELECT * FROM /*prefix*/block WHERE id=?', $blockId);
	}

	/**
	 * @return array|bool
	 */
	public static function getBlocksForBlog () {

		return Kernel::$modelObj->fetch ('SELECT * FROM /*prefix*/block WHERE display_in_blog=1');
	}

	/**
	 * @param $nodeId
	 * @return array
	 */
	public static function getBlocks($nodeId) {

		return Kernel::$modelObj->fetch (
			'SELECT * FROM /*prefix*/block WHERE ' . Kernel::$modelObj->getSQLFindInSet ('display_in_nodes', $nodeId)
		);
	}
}
