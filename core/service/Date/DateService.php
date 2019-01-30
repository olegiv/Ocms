<?php

namespace Ocms\core\service\Date;

/**
 * DateService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 30.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class DateService implements DateServiceInterface {

	/**
	 *
	 * @var \Ocms\core\service\Date\DateService This class instance
	 */
	private static $_instance;
	
	/**
	 *
	 * @var string
	 */
	private static $formatDate = 'M j, Y';

  /**
   * @return DateService
   */
  public static function getInstance(): DateService {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {
		
	}

	/**
	 * 
	 * @param int $timestamp
	 * @return string
	 */
	public static function fromTimestamp(int $timestamp): string {
		
		return date (self::$formatDate, $timestamp);
	}

	/**
	 * @param string $date
	 * @return string
	 */
	public static function formatDateLong (string $date): string {

		return date (self::$formatDate, strtotime ($date));
	}
}
