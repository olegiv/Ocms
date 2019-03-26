<?php

namespace Ocms\core\app\tag\service;

/**
 * TagServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface TagServiceInterface {

	/**
	 * @return TagService
	 */
  public static function getInstance(): TagService;

  /**
   * @param string $tags
   * @return array
   */
  public function getTagsArray(string $tags): array;
}
