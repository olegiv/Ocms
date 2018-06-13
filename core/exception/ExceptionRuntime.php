<?php

namespace Ocms\core\exception;

use Ocms\core\view\View;

/**
 * Description of Exception
 *
 * @author olegiv
 */
class ExceptionRuntime extends ExceptionBase implements ExceptionInterface {

	/**
	 *
	 * @param int $type
	 * @param string $message
	 * @param int $code
	 * @throws \Exception
	 */
	public function __construct (int $type, $message = null, $code = 0) {

		parent::__construct ($type, $message, $code);
		
		switch ($type) {
			case self::E_ACCESS_DENIED:
			case self::E_NOT_FOUND:
			case self::E_METHOD_NOT_ALLOWED:
			case self::E_FATAL:
				http_response_code($type);
				echo View::getInstance()->render('errors/runtime',
								['message' => $this->getMessage (), 'type' => $type]);
				break;
			default:
				throw new \Exception ('Bad exception type: ' . $type);
		}
	}
}
