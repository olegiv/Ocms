<?php

namespace Ocms\core\service\Tags;

/**
 * TagsServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface TagsServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\Tags\TagsService
	 */
  public static function getInstance(): TagsService;

  /**
   * @param string $tags
   * @return array
   */
  public function getTagsArray(string $tags): array;
}
