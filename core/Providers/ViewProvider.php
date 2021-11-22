<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View;

/**
 * ViewProvider Provider Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class ViewProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
    public function register(DiInterface $di): void
    {
        $di->setShared('view', function () use ($di) {
			$ttt = $di->getShared('config')->application->viewsDir;
            $view = new View();
            $view->setViewsDir($di->getShared('config')->application->viewsDir);
            $view->registerEngines([
                '.volt' => 'volt'
            ]);

            return $view;
        });
    }
}
