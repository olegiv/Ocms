<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;

/**
 * Description of BlogController
 *
 * @author olegiv
 */
class BlogController extends NodeControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var Ocms\core\controller\BlogController This class instance
	 */
	static $_instance;

	/**
	 * 
	 * @return Ocms\core\controller\BlogController
	 */
  public static function getInstance(): BlogController {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 * @param int $nodeId
	 * @return \stdClass
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	protected function get (int $nodeId = 0) {

		try {
			if (!($blog = Kernel::$modelObj->getBlog($nodeId))) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Cannot load blog: %s', $nodeId));
			}
		} catch (ExceptionRuntime $e) {}
		return $blog;
	}

	/**
	 *
	 * @return array
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	protected function getList () {

		try {
			if (!($blogs = Kernel::$modelObj->getBlogs())) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Cannot load blogs'));
			}
		} catch (ExceptionRuntime $e) {}
		return $blogs;
	}

	/**
	 *
	 */
	public static function indexAction () {

		if (($blogs = Kernel::$blogControllerObj->getList ())) {
			echo Kernel::$viewObj->render ('blogs',
				array_merge (
					['blogs' => $blogs],
					['blocks' => Kernel::$blockObj->getBlocksForBlogIndex()])
			);
		}
	}

	/**
	 * @todo
	 * @return string
	 */
	public static function renderList () {

		if (($blogs = Kernel::$blogControllerObj->getList ())) {
			$html = Kernel::$viewObj->render ('blogs',	['blogs' => $blogs]);
		}
		return $html;
	}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId = 0) {

		if (($node = Kernel::$blogControllerObj->get ($nodeId))) {
			echo Kernel::$viewObj->render ('extend/blog',
				array_merge ((array)$node,
					['blocks' => Kernel::$blockObj->getBlocksForNode($nodeId)])
			);
		}
	}
}
