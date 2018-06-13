<?php

namespace Ocms\core\exception;

abstract class ExceptionBase extends \Exception implements ExceptionInterface {

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
	 *
	 * @param int $type
	 * @param string $message
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
