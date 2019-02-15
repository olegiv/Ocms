<?php

namespace Ocms\core\controller;

use Ocms\core\Kernel;
use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\model\NodeModel;
use Ocms\core\view\View;

/**
 * NodeController Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.5 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class NodeController extends NodeControllerBase implements NodeControllerInterface {

	/**
	 *
	 * @var \Ocms\core\controller\NodeController This class instance
	 */
	static $_instance;

	/**
	 *
	 * @return \Ocms\core\controller\NodeController
	 */
  public static function getInstance(): NodeController {

		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }

	/**
	 * @param int $nodeId
	 * @return bool|\PDO
	 * @throws \Exception
	 */
	protected static function get (int $nodeId = 0) {

		try {
			if (! ($node = NodeModel::getNode ($nodeId))) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Cannot load page node: %s', $nodeId));
			}
		} catch (ExceptionRuntime $e) {

		}
		return self::preProcess($node);
	}

  /**
   * @param int $nodeId
   * @return bool
   * @throws \Exception
   */
	public function viewErrorPage (int $nodeId): bool {

		if (($pageId = Kernel::$configurationObj->getConfigurationGlobalItem ('Site', 'errorPageIds', $nodeId))) {
			$this->viewAction ($pageId);
			$return = TRUE;
		} else {
			$return = FALSE;
		}
		return $return;
	}

	/**
	 * @param $node
	 * @return string
	 */
	private static function getTemplate ($node): string {

		$template = 'extend/node';

		if (isset ($node->template) && ! empty ($node->template)) {
			if (View::isTemplateValid ($node->template)) {
				$template = $node->template;
			}
		}

		return $template;
	}

  /**
   * @param int $nodeId
   * @return mixed|void
   * @throws \Exception
   */
	public static function viewAction (int $nodeId) {

		if (($node = self::get ($nodeId))) {
			echo Kernel::$viewObj->render(self::getTemplate ($node),
				array_merge((array)$node, [
					'blocks' => Kernel::$blockObj->getBlocksForNode($nodeId),
					'menu' => Kernel::$menuObj->getMenuForNodeHtml($nodeId),
					'site' => Kernel::getSiteConfiguration()
				])
			);
		}
	}
}
