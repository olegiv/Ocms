<?php

namespace Ocms\core\service\Log;

use Ocms\core\Kernel;

/**
 * LogService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class LogService implements LogServiceInterface {

	/**
	 *
	 * @var LogService This class instance
	 */
	static $_instance;

  /**
   * @return LogService
   */
  public static function getInstance(): LogService {

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
	 *
	 * @param string $message
	 */
	public function log (string $message) {

		error_log ($message);
		if (Kernel::inDebug ()) {
			echo '<pre>' . $message . '</pre>';
		}
	}
}
