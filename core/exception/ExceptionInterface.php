<?php

namespace Ocms\core\exception;

use Throwable;

/**
 * ControllerBaseInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface ExceptionInterface {
	
	/* Protected methods inherited from Exception class */

	public function getMessage();								 // Exception message

	public function getCode();										// User-defined Exception code

	public function getFile();										// Source filename

	public function getLine();										// Source line

	public function getTrace();									 // An array of the backtrace()

	public function getTraceAsString();					 // Formatted string of trace

	/* Overrideable methods inherited from Exception class */

	public function __toString();								 // formatted string for display

  /**
   * ExceptionInterface constructor.
   * @param int $type
   * @param string $message
   * @param mixed $code
	 * @param Throwable $previous
   */
	public function __construct (int $type, string $message = '', $code = 0, Throwable $previous = null);
}
