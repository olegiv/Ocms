<?php

namespace Ocms\core\block;

use Ocms\core\Kernel;
use Ocms\core\model\BlockModel;

/**
 * Block Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
class Block extends BlockBase implements BlockInterface {
	
	/**
	 *
	 * @var Block This class instance
	 */
	static $_instance;

	/**
	 * 
	 * @return Block
	 */
  public static function getInstance(): Block {
  
		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {}

  /**
   * @param int $nodeId
   * @return array
   * @throws \Ocms\core\exception\ExceptionRuntime
   */
	public function getBlocksForNode (int $nodeId): array {
	
		if (($blocks = BlockModel::getBlocks($nodeId))) {
			foreach ($blocks as $key => $block) {
				$blocks[$key]->html = $this->renderBlock($block);
			}
		}
		return $blocks;
	}

  /**
   * @return array
   * @throws \Ocms\core\exception\ExceptionRuntime
   */
	public function getBlocksForBlog (): array {
	
		if (($blocks = BlockModel::getBlocksForBlog())) {
			foreach ($blocks as $key => $block) {
				$blocks[$key]->html = $this->renderBlock($block);
			}
		}
		return $blocks;
	}

  /**
   * @param $block
   * @return string
   * @throws \Ocms\core\exception\ExceptionRuntime
   */
	private function renderBlock ($block): string {
		
		if (isset($block->controller) && $block->controller) {
			$block->body = Kernel::$blockControllerObj->renderController($block->controller);
		}
		return $block->body;
	}

	/**
	 *
	 * @return array
	 */
	public function getBlocksForBlogIndex (): array {

		return BlockModel::getBlocksForBlogIndex();
	}

}
