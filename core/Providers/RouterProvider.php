<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Ocms\Core\Models\Nodes;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Mvc\Router;

/**
 * RouterProvider Provider Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class RouterProvider implements ServiceProviderInterface
{
	/**
	 * @param DiInterface $di
	 */
	public function register(DiInterface $di): void
    {
	    $di->setShared('router', function () {

		    $router = new Router();

		    /** @var Nodes[] $node */
		    $nodes = Nodes::find([
			    'alias > ""'
		    ]);

		    if (! empty($nodes)) {
			    foreach ($nodes as $node) {
				    $router->add(
					    $node->alias,
					    [
						    'controller' => 'node',
						    'action'     => 'view',
						    'id'         => $node->id
					    ]
				    );
			    }
		    }

		    return $router;
	    });
    }
}
