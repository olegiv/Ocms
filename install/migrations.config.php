<?php declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Config;

Dotenv::createImmutable(realpath(__DIR__ . '/../'))->load();

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
        'logInDb' => true,
        'migrationsDir' => 'install/db',
        'exportDataFromTables' => [
            'nodes'
        ]
    ]
]);
