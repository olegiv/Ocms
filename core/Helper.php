<?php

use Ocms\core\service\I18n\I18n;

/**
 * 
 * @return string
 */
function t (): string {
	
	return call_user_func_array (array (I18n::getInstance(), 'translate'), func_get_args ());
}

/**
 *
 * @param mixed $var
 */
function dump ($var) {

	echo '<pre>' . var_export ($var, TRUE) . '</pre>';
}
