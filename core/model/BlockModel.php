<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * BlockModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 18.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 -2019, OCMS
 */
class BlockModel {

	/**
	 * @param int $blockId
	 * @return bool
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getBlock (int $blockId) {
		
		return Kernel::$modelObj->single('SELECT * FROM #prefix#node WHERE id=?', $blockId);
	}

	/**
	 * @return bool
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getBlocksForBlog () {
	
		if (($blocks = self::getBlocks())) {
			foreach ($blocks as $key => $block) {
				if (! isset($block->display_in_blog) || ! $block->display_in_blog) {
					unset ($blocks[$key]);
				}
			}
		}
		return $blocks;
	}

	/**
	 * @return bool
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getBlocksForBlogIndex () {

		/**
		 * @todo
		 */
		return self::getBlocks ();
	}

	/**
	 * @param $nodeId
	 * @return bool
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getBlocks($nodeId) {

		return Kernel::$modelObj->fetch (
			'SELECT * FROM #prefix#block WHERE ' . Kernel::$modelObj->getSQLFindInSet ('display_in_nodes', $nodeId)
		);
	}
}
