<?php declare(strict_types=1);

namespace Ocms\Core\Controllers;

/**
 * IndexController Controller Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class IndexController extends ControllerBase
{
	/**
	 *
	 */
	public function initialize()
	{
		parent::initialize();
		$this->tag->setTitle('OCMS | Homepage');
	}

	/**
	 * @return void
	 */
	public function indexAction(): void
	{
	}
}
