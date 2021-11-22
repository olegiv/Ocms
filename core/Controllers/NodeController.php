<?php declare(strict_types=1);

namespace Ocms\Core\Controllers;

use Ocms\Core\Models\Nodes;

/**
 * NodeController Controller Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class NodeController extends ControllerBase
{
	/**
	 * @param $dispatcher
	 * @return bool
	 */
	public function beforeExecuteRoute($dispatcher): bool
	{
		switch ($dispatcher->getActionName()) {
			case 'view':
				$canAccess = true;
				if (!$canAccess) {
					$this->dispatchError();
					return false;
				}
				break;
		}

		return true;
	}

	/**
	 *
	 */
	private function dispatchError()
	{
		$this->dispatcher->forward(
			[
				'controller' => 'home',
				'action'     => 'index'
			]
		);
	}

	/**
	 *
	 */
    public function initialize()
    {
        parent::initialize();
		$this->tag->appendTitle(' | OCMS');
    }

	/**
	 * @param int $id
	 */
    public function viewAction(int $id)
    {
		if (empty($id)) {
			$this->dispatchError();
		}

	    /** @var Nodes $node */
	    $node = Nodes::findFirst([
		    "id = :id:",
		    'bind' => [
			    'id'    => $id
		    ]
	    ]);
		if (! $node) {
			$this->dispatchError();
		}

	    $this->tag->setTitle($node->title);

		$this->view->setVars((array)$node);
    }
}
