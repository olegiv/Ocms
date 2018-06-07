<?php

namespace Ocms\core\service\I18n;

/**
 * Description of I18n
 *
 * @author olegiv
 */
class I18n implements I18nInterface {
	
	/**
	 *
	 * @var I18n This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return I18n
	 */
  public static function getInstance(): I18n {
  
		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {}
	
	/**
	 * 
	 */
	public function init () {

	}

/**
	 * 
	 * @param string $string
	 * @param string $lang
	 * @return string
	 */
	public function translate (string $string, string $lang = ''): string {

		return $string;
	}
	
}

