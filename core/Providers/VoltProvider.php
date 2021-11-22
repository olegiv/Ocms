<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

/**
 * VoltProvider Provider Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class VoltProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
    public function register(DiInterface $di): void
    {
        $view = $di->getShared('view');

        $di->setShared('volt', function () use ($view, $di) {
            $volt = new VoltEngine($view, $di);
            $volt->setOptions([
                'path' => $di->offsetGet('rootPath') . '/var/cache/volt/',
	            'always' => true,
	            'stat' => true
            ]);

            $compiler = $volt->getCompiler();
            $compiler->addFunction('is_a', 'is_a');

            return $volt;
        });
    }
}
