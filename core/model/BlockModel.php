<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * BlockModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
class BlockModel {
	
	/**
	 * 
	 * @param int $blockId
	 * @return \stdClass
	 */
	public static function getBlock (int $blockId) {
		
		return Kernel::$modelObj->single('SELECT * FROM #prefix#node WHERE id=?', $blockId);
	}
	
	/**
	 * 
	 * @return array
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
	 *
	 * @return array
	 */
	public static function getBlocksForBlogIndex () {

		/**
		 * @todo
		 */
		return self::getBlocks ();
	}
	
	/**
	 * 
	 * @return array
	 */
	public static function getBlocks($nodeId = 0) {

		$blocks = Kernel::$modelObj->fetch('SELECT * FROM #prefix#block');

		if ($nodeId && $blocks) {
			foreach ($blocks as $key => $block) {
				if ($block->display_in_nodes) {
					$displayInNodes = explode(',', $block->display_in_nodes);
					if (!in_array($nodeId, $displayInNodes)) {
						if ($block->display_in_nodes_logic) {
							unset($blocks[$key]);
						}
					} else {
						if (!$block->display_in_nodes_logic) {
							unset($blocks[$key]);
						}
					}
				}
			}
		}
		return $blocks;
	}

}
