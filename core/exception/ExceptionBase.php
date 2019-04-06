<?php

namespace Ocms\core\exception;

use Throwable;

/**
 * ExceptionBase Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
abstract class ExceptionBase extends \Exception implements ExceptionInterface {

	const E_CONTINUE = 100;
	const E_WARNING = 199;
	const E_ACCESS_DENIED = 403;
	const E_NOT_FOUND = 404;
	const E_METHOD_NOT_ALLOWED = 405;
	const E_BAD_PARAMETER = 422;
	const E_FATAL = 500;

	protected $message = 'Unknown exception';		 // Exception message
	private $string;														// Unknown
	protected $code = 0;											 // User-defined exception code
	protected $file;															// Source filename of exception
	protected $line;															// Source line of exception
	private $trace;														 // Unknown

  /**
   * ExceptionBase constructor.
   * @param int $type
   * @param string $message
   * @param mixed $code
	 * @param Throwable $previous
   */
	public function __construct (int $type, string $message = '', $code = null, Throwable $previous = null) {

		parent::__construct ($message, (int)$code);
	}

	/**
	 *
	 * @return string
	 */
	public function __toString (): string {
		
		return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
						. "{$this->getTraceAsString()}";
	}
}
