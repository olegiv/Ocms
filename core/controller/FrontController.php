<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;
use Ocms\core\model\NodeModel;

/**
 * FrontController Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.5 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class FrontController extends NodeControllerBase implements FrontControllerInterface {

	/**
	 *
	 * @var FrontController This class instance
	 */
	static $_instance;

	/**
	 *
	 * @return FrontController
	 */
  public static function getInstance(): FrontController {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * @param $nodeId
   * @return \stdClass|bool
   */
	protected function get ($nodeId) {

		try {
			if (!($node = NodeModel::getNode($nodeId))) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Cannot load Home page node: %s', $nodeId));
			}
		} catch (ExceptionRuntime $e) {
			$node = false;
		}
		return $node;
	}

  /**
   * @param int $nodeId
   */
	public static function viewAction (int $nodeId) {

		try {
			if (!($nodeId = Kernel::$configurationObj->getHomePageId())) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t('Cannot get home page ID'));
			}
			echo Kernel::$viewObj->render('extend/front',
				array_merge((array)Kernel::$frontControllerObj->get($nodeId), [
					'blocks' => Kernel::$blockObj->getBlocksForNode($nodeId),
					'menu' => Kernel::$menuObj->getMenuForNodeHtml($nodeId),
					'site' => Kernel::getSiteConfiguration()
				])
			);
		} catch (ExceptionRuntime $e) {}
	}
}
