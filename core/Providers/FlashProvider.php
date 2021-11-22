<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Flash\Direct as FlashDirect;

/**
 * FlashProvider Provider Class.
 *
 * Registers the flash service with custom CSS classes.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class FlashProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
    public function register(DiInterface $di): void
    {
        $di->setShared('flash', function () {
            $flash = new FlashDirect();
            $flash->setImplicitFlush(false);
            $flash->setCssClasses([
                'error' => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice' => 'alert alert-info',
                'warning' => 'alert alert-warning'
            ]);

            return $flash;
        });
    }
}
