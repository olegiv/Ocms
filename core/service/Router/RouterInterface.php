<?php

namespace Ocms\core\service\Router;

/**
 * Description of Router
 *
 * @author olegiv
 */
interface RouterInterface {

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
