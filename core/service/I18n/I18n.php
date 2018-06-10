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
	 * @var array
	 */
	private $lang_hash = [];
	
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
	private function __construct() {
		
		$this->loadTranslations();
	}
	
	/**
	 * 
	 */
	private function loadTranslations () {

	}

	/**
	 * 
	 * @return string
	 */
	public function translate (): string {
		
		$args = func_get_args ();

		if (! ($original = array_shift ($args))) {
			return '';
		}

		if (isset ($args[0]) && is_array ($args[0])) {
			$args = $args[0];
		}

		foreach (array_keys ($this->lang_hash) as $lang) {
			if (! empty ($this->lang_hash[$lang][$original])) {
				return vsprintf ($this->lang_hash[$lang][$original], $args);
			}
		}

		return vsprintf ($original, $args);
	}	
}
