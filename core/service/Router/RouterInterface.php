<?php

namespace Ocms\core\service\Router;

/**
 * RouterInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface RouterInterface {

	/**
	 * 
	 * @return \Ocms\core\service\Router\Router
	 */
  public static function getInstance(): Router;

	/**
	 * 
	 */
	public function run ();
	
	/**
	 * 
	 * @return array
	 */
	//public function getParams (): array;
	
	/**
	 * 
	 * @param string $key
	 * @return string
	 */
	//public function getParam (string $key): string;
}
