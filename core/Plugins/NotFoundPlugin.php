<?php declare(strict_types=1);

namespace Ocms\Core\Plugins;

use Exception;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

/**
 * NotFoundPlugin Plugin Class.
 *
 * Handles not-found controller/actions.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class NotFoundPlugin extends Injectable
{
    /**
     * This action is executed before perform any action in the application
     *
     * @param Event $event
     * @param MvcDispatcher $dispatcher
     * @param Exception $exception
     * @return bool
     */
    public function beforeException(Event $event, MvcDispatcher $dispatcher, Exception $exception): bool
	{
	    error_log($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());

        if ($exception instanceof DispatcherException) {
            switch ($exception->getCode()) {
                case DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
                case DispatcherException::EXCEPTION_ACTION_NOT_FOUND:

                    $dispatcher->forward([
                        'controller' => 'errors',
                        'action'     => 'show404'
                    ]);

                    return false;
            }
        }

        if ($dispatcher->getControllerName() !== 'errors') {
            $dispatcher->forward([
                'controller' => 'errors',
                'action'     => 'show500'
            ]);
        }

        return !$event->isStopped();
    }
}
