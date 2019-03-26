<?php

namespace Ocms\core\exception;

use Ocms\core\Kernel;
use Ocms\core\controller\NodeController;

/**
 * ExceptionRuntime Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class ExceptionRuntime extends ExceptionBase implements ExceptionInterface {

  /**
   * ExceptionRuntime constructor.
   * @param int $type
   * @param null $message
   * @param int $code
   * @throws \Exception
   */
	public function __construct (int $type, $message = null, $code = 0) {

		Kernel::$logObj->log ($this->getMessage ());

		switch ($type) {
			case self::E_CONTINUE:
				break;
			case self::E_NOT_FOUND:
			case self::E_ACCESS_DENIED:
			case self::E_METHOD_NOT_ALLOWED:
				parent::__construct ($type, $message, $code);
				http_response_code ($type);
				if (! Kernel::$nodeControllerObj->viewErrorPage ($type)) {
					echo Kernel::$viewObj->render ('extend/error/runtime',
					['message' => $this->getMessage (), 'type' => $type]);
				}
				break;
			case self::E_FATAL:
				parent::__construct ($type, $message, $code);
				break;
			default:
				parent::__construct ($type, $message, $code);
				echo Kernel::$viewObj->render ('extend/error/runtime',
					['message' => $this->getMessage (), 'type' => $type]);
				throw new \Exception ('Bad exception type: ' . $type);
		}
	}
}
