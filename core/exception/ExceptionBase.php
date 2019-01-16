<?php

namespace Ocms\core\exception;

/**
 * ExceptionBase Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
abstract class ExceptionBase extends \Exception implements ExceptionInterface {

	const E_CONTINUE = 100;
	const E_ACCESS_DENIED = 403;
	const E_NOT_FOUND = 404;
	const E_METHOD_NOT_ALLOWED = 405;
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
   * @param null $message
   * @param int $code
   * @throws \Exception
   */
	public function __construct (int $type, $message = null, $code = 0) {

		if (!$message) {
			throw new \Exception ('Unknown ' . get_class ($this));
		}
		parent::__construct ($message, $code);
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
