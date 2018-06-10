<?php

namespace Ocms\core;

use Ocms\core\block\Block;
use Ocms\core\model\Model;
use Ocms\core\view\View;
use Ocms\core\service\Router\Router;
use Ocms\core\service\I18n\I18n;

require_once 'core/Helper.php';

/**
 * Description of Kernel
 *
 * @author olegiv
 */
class Kernel implements KernelInterface {
	
	/**
	 *
	 * @var Kernel This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var Router 
	 */
	private $routerInstance;
	
	/**
	 * 
	 * @return Kernel
	 */
  public static function getInstance(): Kernel {
  
		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {
				
		Model::getInstance();
		View::getInstance();
		I18n::getInstance();
		$this->routerInstance = Router::getInstance();
		Block::getInstance();
	}
	
	/**
	 * 
	 */
	public function run () {
		
		$this->routerInstance->run();
	}
}
