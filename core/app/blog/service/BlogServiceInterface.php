<?php

namespace Ocms\core\app\blog\service;

/**
 * BlogServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.2 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
interface BlogServiceInterface {

	/**
	 * @return BlogService
	 */
  public static function getInstance(): BlogService;
}
