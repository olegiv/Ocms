<?php

namespace Ocms\core\controller;

use Ocms\core\Kernel;
use Ocms\core\exception\ExceptionRuntime;

/**
 * Description of NodeController
 *
 * @author olegiv
 */
class NodeController extends NodeControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var Ocms\core\controller\NodeController This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return Ocms\core\controller\NodeController
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
			if (! ($node = Kernel::$modelObj->getNode ($nodeId))) {
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

		echo Kernel::$viewObj->render ('extend/node',
			array_merge ((array) Kernel::$nodeControllerObj->get ($nodeId),
				['blocks' => Kernel::$blockObj->getBlocksForNode ($nodeId)])
		);
	}
}
