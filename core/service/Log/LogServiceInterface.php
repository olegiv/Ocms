<?php

namespace Ocms\core\service\Log;

/**
 * Description of LogService
 *
 * @author olegiv
 */
interface LogServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\Log\LogService
	 */
  public static function getInstance(): LogService; 
	
}
