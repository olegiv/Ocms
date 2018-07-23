<?php

namespace Ocms\core\service\Tags;

/**
 * Description of TagsService
 *
 * @author olegiv
 */
class TagsService implements TagsServiceInterface {

	/**
	 *
	 * @var Ocms\core\service\Tags\TagsService This class instance
	 */
	private static $_instance;
	
	/**
	 * 
	 * @return Ocms\core\service\Tags\TagsService
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

	public function getTagsArray(string $tags) {
		
		return explode(' ', $tags);
	}

}
