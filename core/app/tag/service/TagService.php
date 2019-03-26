<?php

namespace Ocms\core\app\tag\service;

/**
 * TagService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class TagService implements TagServiceInterface {

	/**
	 *
	 * @var TagService This class instance
	 */
	private static $_instance;

  /**
   * @return TagService
   */
  public static function getInstance(): TagService {
  
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
   * @param string $tags
   * @return array
   */
	public function getTagsArray (string $tags): array {
		
		return explode(' ', $tags);
	}
}
