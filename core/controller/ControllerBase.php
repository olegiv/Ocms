<?php

namespace Ocms\core\controller;

/**
 * Description of FrontController
 *
 * @author olegiv
 */
abstract class ControllerBase implements ControllerBaseInterface {
	
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
	 */
	protected function getConfig () {
		
	}
	
	/**
	 * 
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId = 0) {
		
		
	} 
}
