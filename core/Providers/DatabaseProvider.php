<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * DatabaseProvider Provider Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class DatabaseProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
    public function register(DiInterface $di): void
    {
        $dbConfig = $di->getShared('config')->get('database')->toArray();
        $di->setShared('db', function () use ($dbConfig) {
            $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $dbConfig['adapter'];
            unset($dbConfig['adapter']);

            return new $dbClass($dbConfig);
        });
    }
}
