<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Exception;

/**
 * ConfigProvider Provider Class.
 *
 * Reads the configuration.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class ConfigProvider implements ServiceProviderInterface
{
	/**
	 * @throws Exception
	 */
	public function register(DiInterface $di): void
    {
        $configPath = $di->offsetGet('rootPath') . '/config/config.php';
        if (!file_exists($configPath) || !is_readable($configPath)) {
            throw new Exception('Config file does not exist: ' . $configPath);
        }

        $di->setShared('config', function () use ($configPath) {
            return require_once $configPath;
        });
    }
}
