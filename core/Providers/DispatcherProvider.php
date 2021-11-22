<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Ocms\Core\Plugins\NotFoundPlugin;
use Ocms\Core\Plugins\SecurityPlugin;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;

/**
 * Events manager.
 */

/**
 * DispatcherProvider Provider Class.
 *
 * Events manager.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class DispatcherProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
    public function register(DiInterface $di): void
    {
        $di->setShared('dispatcher', function () {

            $eventsManager = new EventsManager();

            /**
             * Check if the user is allowed to access certain action using the SecurityPlugin
             */
            $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);

            /**
             * Handle exceptions and not-found exceptions using NotFoundPlugin
             */
            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Ocms\Core\Controllers');
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });
    }
}
