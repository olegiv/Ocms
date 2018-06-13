<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\service\Configuration\ConfigurationService;
use Ocms\core\block\Block;
use Ocms\core\model\Model;
use Ocms\core\view\View;

/**
 * Description of FrontController
 *
 * @author olegiv
 */
class FrontController extends NodeControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var FrontController This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return FrontController
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
	 * @throws ExceptionRuntime
	 */
	protected function get ($nodeId) {
		
		if (!($node = Model::getInstance()->getNode($nodeId))) {
			throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, 'Cannot load Home page node: %s', $nodeId);
		}
		return $node;
	}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction(int $nodeId = 0) {

		if (! ($nodeId = ConfigurationService::getInstance()->getHomePageId ())) {
			throw new ExceptionRuntime (ExceptionRuntime::E_FATAL, t ('Cannot get home page ID'));
		}
		echo View::getInstance()->render ('node',
			array_merge ((array) self::getInstance()->get($nodeId),
				['blocks' => Block::getInstance()->getBlocksForNode($nodeId)])
		);
	}
}
