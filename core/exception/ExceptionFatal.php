<?php

namespace Ocms\core\exception;

use Throwable;

/**
 * ExceptionFatal Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class ExceptionFatal extends ExceptionBase implements ExceptionInterface {

	const DEFAULT_ERROR_MESSAGE = 'The website encountered an unexpected error. Please try again later.';

	/**
	 *
	 * @param int $type
	 * @param string $message
	 * @param mixed $code
	 * @param Throwable $previous
	 */
	public function __construct (int $type, string $message = '', $code = 0, Throwable $previous = null) {

		parent::__construct ($type, $message, $code, $previous);

		http_response_code (self::E_FATAL);

		$error_message = $this->__toString ();
		error_log ($error_message);

		if (ini_get ('display_errors')) {
			die ($error_message);
		} else {
			die (self::DEFAULT_ERROR_MESSAGE);
		}
	}
}
