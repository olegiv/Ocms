<?php

namespace Ocms\core\exception;

use Ocms\core\Kernel;
use Throwable;

/**
 * ExceptionRuntime Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.4 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class ExceptionRuntime extends ExceptionBase implements ExceptionInterface {

  /**
   * ExceptionRuntime constructor.
   * @param int $type
   * @param string $message
   * @param mixed $code
	 * @param Throwable $previous
   */
	public function __construct (int $type, string $message = '', $code = 0, Throwable $previous = null) {

		parent::__construct ($type, $message, $code, $previous);

		$errorMessage = $this->__toString ();

		Kernel::$logObj->log ($errorMessage);

		switch ($type) {
			case self::E_CONTINUE:
			case self::E_WARNING:
			case self::E_FATAL:
				break;
			case self::E_NOT_FOUND:
			case self::E_ACCESS_DENIED:
			case self::E_METHOD_NOT_ALLOWED:
				http_response_code ($type);
				if (! Kernel::$nodeControllerObj->viewErrorPage ($type)) {
					echo Kernel::$viewObj->render ('extend/error/runtime',
					['message' => $this->getMessage (), 'type' => $type]);
				}
				break;
			default:
				echo Kernel::$viewObj->render ('extend/error/runtime',
					['message' => $this->getMessage (), 'type' => $type]);
				http_response_code (self::E_FATAL);
				die ('Bad exception type: ' . $type);
		}
	}
}
