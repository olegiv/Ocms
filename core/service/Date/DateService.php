<?php

namespace Ocms\core\service\Date;

/**
 * Description of DateService
 *
 * @author olegiv
 */
class DateService implements DateServiceInterface {

	/**
	 *
	 * @var Ocms\core\service\Date\DateService This class instance
	 */
	private static $_instance;
	
	/**
	 *
	 * @var string
	 */
	private static $formatDate = 'M j, Y';

	/**
	 * 
	 * @return Ocms\core\service\Date\DateService
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
		
		return date(self::$formatDate, $timestamp);
	}

}
