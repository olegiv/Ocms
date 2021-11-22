<?php declare(strict_types=1);

use Phalcon\Config;

return new Config([
    'database' => [
        'adapter' => getenv('DB_ADAPTER'),
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'dbname' => getenv('DB_NAME'),
        'charset' => getenv('DB_CHARSET')
    ],
    'application' => [
        'layoutDir' => getenv('LAYOUT_DIR'),
	    'viewsDir' => '../html/' . getenv('LAYOUT_DIR') . 'volt/',
        'baseUri' => getenv('BASE_URI')
    ]
]);
