<?php

namespace Ocms\core\controller;

use Ocms\core\Kernel;
use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\model\NodeModel;

/**
 * NodeController Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.4 01.02.2019
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
   * @param int $nodeId
   * @return mixed|void
   * @throws \Exception
   */
	public static function viewAction (int $nodeId) {

		echo Kernel::$viewObj->render ('extend/node',
			array_merge ((array) self::get ($nodeId), [
				'blocks' => Kernel::$blockObj->getBlocksForNode ($nodeId),
				'menu' => Kernel::$menuObj->getMenuForNode($nodeId),
				'analytics' => Kernel::$analyticsObj->getTrackerHtmlCode (),
				'site' => Kernel::getSiteConfiguration ()
			])
		);
	}
}
