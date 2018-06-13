<?php

namespace Ocms\core\exception;

interface ExceptionInterface {
	
	/* Protected methods inherited from Exception class */

	public function getMessage();								 // Exception message

	public function getCode();										// User-defined Exception code

	public function getFile();										// Source filename

	public function getLine();										// Source line

	public function getTrace();									 // An array of the backtrace()

	public function getTraceAsString();					 // Formated string of trace

	/* Overrideable methods inherited from Exception class */

	public function __toString();								 // formated string for display

	/**
	 *
	 * @param int $type
	 * @param string $message
	 * @param int $code
	 * @throws \Exception
	 */
	public function __construct (int $type, $message = null, $code = 0);
}
