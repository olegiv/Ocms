<?php

namespace Ocms\core\exception;

/**
 * ExceptionFatal Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
class ExceptionFatal extends ExceptionBase implements ExceptionInterface {

	/**
	 *
	 * @param int $type
	 * @param string $message
	 * @param int $code
	 * @throws \Exception
	 */
	public function __construct (int $type, $message = null, $code = 0) {

		parent::__construct ($type, $message, $code);
		http_response_code(self::E_FATAL);
		die ($this->getMessage ());
	}
}
