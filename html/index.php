<?php

use Ocms\core\Kernel;

try {

	require_once __DIR__ . '/../autoload.php';
	require_once __DIR__ . '/../vendor/autoload.php';

	$kernel = Kernel::getInstance(__DIR__);
	$kernel->run();

} catch (Throwable $e) {

	if (ini_get ('display_errors')) {
		error_log (($error_message = $e->__toString ()));
		die ($error_message);
	} else {
		die ('The website encountered an unexpected error. Please try again later.');
	}
}
