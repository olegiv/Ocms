<?php

namespace Ocms\core\controller;

use Ocms\core\view\View;

/**
 * Description of FrontController
 *
 * @author olegiv
 */
class FrontController extends ControllerBase {
	
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
	 */
	private function __construct() {}

	/**
	 * 
	 */
	protected function init() {
		
		//parent::init();
	}
	
	/**
	 * 
	 */
	public function run() {
		
		$this->init();
		
		echo View::getInstance()->render('index', ['name' => 'Kylie the Opossum']);
		
		//parent::run();
	}
	
}
