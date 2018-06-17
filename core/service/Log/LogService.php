<?php

namespace Ocms\core\service\Log;

use Ocms\core\Kernel;

/**
 * Description of LogService
 *
 * @author olegiv
 */
class LogService implements LogServiceInterface {

	/**
	 *
	 * @var Ocms\core\service\Log\LogService This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return Ocms\core\service\Log\Log
	 */
  public static function getInstance(): LogService {
  
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
	 * @param string $message
	 */
	public function log ($message) {
		
		error_log ($message);
		if (Kernel::inDebug()) {
			echo $message;
		}
	}

}
