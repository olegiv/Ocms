<?php declare(strict_types=1);

namespace Ocms\Core\Controllers;

/**
 * ErrorsController Controller Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class ErrorsController extends ControllerBase
{
	/**
	 *
	 */
	public function initialize()
    {
        parent::initialize();
		$this->view->setTemplateAfter('error');
	    $this->tag->appendTitle(' | OCMS');
    }

	/**
	 * @param int $code
	 * @param string $message
	 */
	private function displayError(int $code, string $message)
	{
		$this->tag->setTitle($message);
		$this->response->setStatusCode($code);
		$this->view->setVar('title', $message);
	}

	/**
	 *
	 */
    public function show404Action(): void
    {
	    $this->displayError(404, '404 - Page not found');
    }

	/**
	 *
	 */
    public function show401Action(): void
    {
	    $this->displayError(401, '401 - Unauthorized');
    }

	/**
	 *
	 */
    public function show500Action(): void
    {
	    $this->displayError(500, '500 - Server error');
    }
}
