<?php

namespace Ocms\core\exception;

/**
 * ControllerBaseInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
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
   * @param null $message
   * @param int $code
   */
	public function __construct (int $type, $message = null, $code = 0);
}
