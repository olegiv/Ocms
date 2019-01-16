<?php

namespace Ocms\core\service\Tags;

/**
 * TagsService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
class TagsService implements TagsServiceInterface {

	/**
	 *
	 * @var \Ocms\core\service\Tags\TagsService This class instance
	 */
	private static $_instance;

  /**
   * @return TagsService
   */
  public static function getInstance(): TagsService {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {
		
	}

  /**
   * @param string $tags
   * @return array
   */
	public function getTagsArray (string $tags): array {
		
		return explode(' ', $tags);
	}
}
