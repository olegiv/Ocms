<?php

namespace Ocms\core\service\I18n;

/**
 * I18n Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
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

		$this->lang_hash['en'] = [];
	}

	/**
	 *
	 * @return string
	 */
	public function translate (): string {

		$args = func_get_args ();

		$return = '';

		if (($original = array_shift ($args))) {

			if (isset ($args[0]) && is_array ($args[0])) {
				$args = $args[0];
			}

			foreach (array_keys ($this->lang_hash) as $lang) {
				if (! empty ($this->lang_hash[$lang][$original])) {
					$return = vsprintf ($this->lang_hash[$lang][$original], $args);
					break;
				}
			}

			return vsprintf ($original, $args);
		}

		return $return;
	}
}
