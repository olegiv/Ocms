<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Url;

/**
 * UrlProvider Provider Class.
 *
 * The URL component is used to generate all kind of urls in the application
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class UrlProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
    public function register(DiInterface $di): void
    {
        $baseUri = $di->getShared('config')->application->baseUri;
        $di->setShared('url', function () use ($baseUri) {
            $url = new Url();
            $url->setBaseUri($baseUri);
            return $url;
        });
    }
}
