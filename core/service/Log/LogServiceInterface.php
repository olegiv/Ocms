<?php

namespace Ocms\core\service\Log;

/**
 * LogServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface LogServiceInterface {

  /**
   * @return LogService
   */
  public static function getInstance(): LogService;

	/**
	 *
	 * @param string $message
	 */
	public function log (string $message);
}
