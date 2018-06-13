<?php

namespace Ocms\core\exception;

/**
 * Description of Exception
 *
 * @author olegiv
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
