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
 * @version 0.0.4 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
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
	 * @param int $blockId
	 * @return bool|object
	 */
	protected function getById(int $blockId) {

		return BlockModel::getById($blockId);
	}

	/**
	 * @param int $blockId
	 * @return string
	 */
	public function renderBlockById(int $blockId): string {

		$return = '';
		if ($block = $this->getById($blockId)) {
			$return = $this->renderBlock($block);
		}
		return $return;
	}

  /**
   * @param int $nodeId
   * @return array
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
	 * @todo: get blocks for a form, now gets blocks for the homepage
	 */
	public function getBlocksForForm (): array {

		if (($blocks = BlockModel::getBlocks (Kernel::$configurationObj->getHomePageId ()))) {
			foreach ($blocks as $key => $block) {
				$blocks[$key]->html = $this->renderBlock($block);
			}
		}
		return $blocks;
	}

  /**
   * @return array
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
   */
	private function renderBlock ($block): string {

		if (isset($block->controller) && $block->controller) {
			$block->body = Kernel::$blockControllerObj->renderController($block->controller);
		}
		if (Kernel::inDebug ()) {
			$return = '<!-- Block begin: ' . $block->id . '-->' . NEW_LINE .
				$block->body . '<!-- Block end: ' . $block->id . '-->' . NEW_LINE;
		} else {
			$return = $block->body;
		}

		return $return;
	}
}
