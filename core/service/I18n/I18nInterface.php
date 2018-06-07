<?php

namespace Ocms\core\service\I18n;

/**
 * Description of I18n
 *
 * @author olegiv
 */
interface I18nInterface {
	
	/**
	 * 
	 */
	public function init ();
	
	/**
	 * 
	 * @param string $string
	 * @param string $lang
	 * @return string
	 */
	public function translate (string $string, string $lang = ''): string;
}
