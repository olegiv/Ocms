<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;

/**
 * Description of FrontController
 *
 * @author olegiv
 */
class FrontController extends NodeControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var Ocms\core\controller\FrontController This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return Ocms\core\controller\FrontController
	 */
  public static function getInstance(): FrontController {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 *
	 * @param int $nodeId
	 * @return \stdClass
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	protected function get ($nodeId) {
		
		if (!($node = Kernel::$modelObj->getNode($nodeId))) {
			throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, 'Cannot load Home page node: %s', $nodeId);
		}
		return $node;
	}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction(int $nodeId = 0) {

		if (! ($nodeId = Kernel::$configurationObj->getHomePageId ())) {
			throw new ExceptionRuntime (ExceptionRuntime::E_FATAL, t ('Cannot get home page ID'));
		}
		echo Kernel::$viewObj->render ('extend/node',
			array_merge ((array) Kernel::$frontControllerObj->get($nodeId),
				['blocks' => Kernel::$blockObj->getBlocksForNode($nodeId)])
		);
	}
}
