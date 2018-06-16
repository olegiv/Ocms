<?php

use Ocms\core\Kernel;

/**
 * 
 * @return string
 */
function t (): string {
	
	return call_user_func_array (array (Kernel::$i18nObj, 'translate'), func_get_args ());
}

/**
 *
 * @param mixed $var
 */
function dump ($var) {

	echo '<pre>' . var_export ($var, TRUE) . '</pre>';
}
