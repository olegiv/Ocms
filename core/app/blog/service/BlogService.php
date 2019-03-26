<?php

namespace Ocms\core\app\blog\service;

/**
 * BlogService Class.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.0 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class BlogService implements BlogServiceInterface {

	/**
	 *
	 * @var BlogService This class instance
	 */
	private static $_instance;

  /**
   * @return BlogService
   */
  public static function getInstance(): BlogService {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {}
}
