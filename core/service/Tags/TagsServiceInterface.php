<?php

namespace Ocms\core\service\Tags;

/**
 * Description of TagsServiceInterface
 *
 * @author olegiv
 */
interface TagsServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\Tags\TagsService
	 */
  public static function getInstance(): TagsService; 
	

	
}
