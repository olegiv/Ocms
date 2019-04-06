<?php

namespace Ocms\core\service\Router;

/**
 * RouterInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface RouterInterface {

	/**
	 * 
	 * @return Router
	 */
  public static function getInstance(): Router;

	/**
	 * 
	 */
	public function run ();
}
