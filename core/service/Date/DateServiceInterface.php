<?php

namespace Ocms\core\service\Date;

/**
 * Description of DateServiceInterface
 *
 * @author olegiv
 */
interface DateServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\Date\DateService
	 */
  public static function getInstance(): DateService; 
	
	/**
	 * 
	 * @param int $timestamp
	 * @return string
	 */
	public static function fromTimestamp(int $timestamp): string;
	
}
