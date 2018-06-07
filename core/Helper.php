<?php

use Ocms\core\service\I18n\I18n;

/**
 * 
 * @param string $string
 * @param string $lang
 * @return string
 */
function t(string $string, string $lang = ''): string {
	
	
	return I18n::getInstance()->translate ($string, $lang);
}
