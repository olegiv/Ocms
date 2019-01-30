<?php

namespace Ocms\core\service\Date;

/**
 * DateServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 30.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface DateServiceInterface {

  /**
   * @return DateService
   */
  public static function getInstance(): DateService; 
	
	/**
	 * 
	 * @param int $timestamp
	 * @return string
	 */
	public static function fromTimestamp(int $timestamp): string;

	/**
	 * @param string $date
	 * @return string
	 */
	public static function formatDateLong (string $date): string;
}
