<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\block\Block;
use Ocms\core\model\Model;
use Ocms\core\view\View;

/**
 * Description of NodeController
 *
 * @author olegiv
 */
class NodeController extends NodeControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var NodeController This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return NodeController
	 */
  public static function getInstance(): NodeController {
  
		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 * @param int $nodeId
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	protected function get (int $nodeId = 0) {
		
		try {
			if (! ($node = Model::getInstance()->getNode ($nodeId))) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Cannot load page node: %s', $nodeId));
			}
		} catch (ExceptionRuntime $e) {
			
		}
		return $node;
	}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId = 0) {

		echo View::getInstance()->render ('node',
			array_merge ((array) self::getInstance()->get ($nodeId),
				['blocks' => Block::getInstance()->getBlocksForNode ($nodeId)])
		);
	}
}
