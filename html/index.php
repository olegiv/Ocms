<?php declare(strict_types=1);

use Dotenv\Dotenv;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

try {

	$rootPath = realpath('..');
	require_once $rootPath . '/vendor/autoload.php';

	/**
	 * Load configuration from .env
	 */
	Dotenv::createImmutable($rootPath)->load();

	/**
	 * Init Phalcon Dependency Injection
	 */
	$di = new FactoryDefault();
	$di->offsetSet('rootPath', function() use ($rootPath) {
		return $rootPath;
	});

	/**
	 * Register Service Providers
	 */
	$providersFile = $rootPath . '/config/providers.php';
	if (!file_exists($providersFile) || !is_readable($providersFile)) {
		throw new Exception('File /config/providers.php does not exist or is not readable.');
	}

	/** @var array $providers */
	$providers = include_once $providersFile;
	foreach ($providers as $provider) {
		$di->register(new $provider());
	}

	(new Application($di))
		->handle($_SERVER['REQUEST_URI'])
		->send();

} catch (Exception $e) {
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}
