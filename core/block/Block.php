<?php

namespace Ocms\core\block;

use Ocms\core\Kernel;

/**
 * Description of NodeController
 *
 * @author olegiv
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
	 * 
	 * @param int $nodeId
	 * @return array
	 */
	public function getBlocksForNode (int $nodeId): array {
	
		return Kernel::$modelObj->getBlocks();
	}

	/**
	 *
	 * @return array
	 */
	public function getBlocksForBlogIndex (): array {

		return Kernel::$modelObj->getBlocksForBlogIndex();
	}

}
