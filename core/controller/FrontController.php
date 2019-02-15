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
 * @version 0.0.4 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class FrontController extends NodeControllerBase implements FrontControllerInterface {

	/**
	 *
	 * @var \Ocms\core\controller\FrontController This class instance
	 */
	static $_instance;

	/**
	 *
	 * @return \Ocms\core\controller\FrontController
	 */
  public static function getInstance(): FrontController {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * @param $nodeId
   * @return \stdClass
   * @throws ExceptionRuntime
   */
	protected function get ($nodeId) {

		if (!($node = NodeModel::getNode($nodeId))) {
			throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, 'Cannot load Home page node: %s', $nodeId);
		}
		return $node;
	}

  /**
   * @param int $nodeId
   * @return mixed|void
   * @throws ExceptionRuntime
   */
	public static function viewAction (int $nodeId) {

		if (! ($nodeId = Kernel::$configurationObj->getHomePageId ())) {
			throw new ExceptionRuntime (ExceptionRuntime::E_FATAL, t ('Cannot get home page ID'));
		}
		echo Kernel::$viewObj->render ('extend/front',
			array_merge ((array) Kernel::$frontControllerObj->get($nodeId), [
				'blocks' => Kernel::$blockObj->getBlocksForNode($nodeId),
				'menu' => Kernel::$menuObj->getMenuForNodeHtml($nodeId),
				'site' => Kernel::getSiteConfiguration()
			])
		);
	}
}
