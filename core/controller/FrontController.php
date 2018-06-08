<?php

namespace Ocms\core\controller;

use Ocms\core\exeption\Exception;
use Ocms\core\service\Configuration\ConfigurationService;
use Ocms\core\model\Model;
use Ocms\core\view\View;

/**
 * Description of FrontController
 *
 * @author olegiv
 */
class FrontController extends ControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var FrontController This class instance
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
	public $node;

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
	 */
	private function __construct() {}
	
	/**
	 * 
	 * @param int $nodeId
	 */
	protected function init (int $nodeId = 0) {
		
		$this->nodeId = ConfigurationService::getInstance()->getHomePageId();
		if (!($this->node = Model::getInstance()->getNode($this->nodeId))) {
			throw new Exception('Cannot load Home page node');
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
