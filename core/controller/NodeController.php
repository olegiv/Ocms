<?php

namespace Ocms\core\controller;

use Ocms\core\model\Model;
use Ocms\core\view\View;

/**
 * Description of NodeController
 *
 * @author olegiv
 */
class NodeController extends ControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var NodeController This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var int 
	 */
	protected $nodeId;
	
	/**
	 *
	 * @var 
	 */
	protected $node;

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
	 */
	private function __construct() {}
	
	/**
	 * 
	 * @param int $nodeId
	 */
	protected function init (int $nodeId = 0) {
		
		$this->nodeId = $nodeId;
		if (!($this->node = Model::getInstance()->getNode($this->nodeId))) {
			throw new \Exception('Cannot load page node: ' . $this->nodeId);
		}
	}
	
	/**
	 * 
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId = 0) {
		
		self::getInstance()->init ($nodeId);
		echo View::getInstance()->render('index', (array) self::getInstance()->node);
	}
	
}
