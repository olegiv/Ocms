<?php declare(strict_types=1);

namespace Ocms\Core\Controllers;

use Phalcon\Mvc\Controller;

/**
 * ControllerBase Controller Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 22.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class ControllerBase extends Controller
{
	/**
	 *
	 */
    protected function initialize()
    {
		$this->view->setVar('layout_dir', $this->di->getShared('config')->application->layoutDir);
	    $this->view->setVar('current_language', 'en');
    }
}
