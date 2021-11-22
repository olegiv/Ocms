<?php declare(strict_types=1);

namespace Ocms\Core\Providers;

use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;

/**
 * CoreProvider Provider Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class CoreProvider implements ServiceProviderInterface
{
	const VERSION = '0.1.0';

	/**
	 * @param DiInterface $di
	 */
	public function register(DiInterface $di): void
	{
		// TODO: Implement register() method.
	}
}
