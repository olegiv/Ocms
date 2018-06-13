<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\block\Block;
use Ocms\core\model\Model;
use Ocms\core\view\View;

/**
 * Description of BlogController
 *
 * @author olegiv
 */
class BlogController extends NodeControllerBase implements ControllerInterface {
	
	/**
	 *
	 * @var NodeController This class instance
	 */
	static $_instance;

	/**
	 * 
	 * @return BlogController
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
			if (!($blog = Model::getInstance()->getBlog($nodeId))) {
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
			if (!($blogs = Model::getInstance()->getBlogs())) {
				throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t ('Cannot load blogs'));
			}
		} catch (ExceptionRuntime $e) {}
		return $blogs;
	}

	/**
	 *
	 */
	public static function indexAction () {

		if (($blogs = self::getInstance ()->getList ())) {
			echo View::getInstance()->render ('blogs',
				array_merge (
					['blogs' => $blogs],
					['blocks' => Block::getInstance()->getBlocksForBlogIndex()])
			);
		}
	}

	/**
	 * @todo
	 * @return string
	 */
	public static function renderList () {

		if (($blogs = self::getInstance ()->getList ())) {
			$html = View::getInstance()->render ('blogs',	['blogs' => $blogs]);
		}
		return $html;
	}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId = 0) {

		if (($node = self::getInstance()->get ($nodeId))) {
			echo View::getInstance()->render ('blog',
				array_merge ((array)$node,
					['blocks' => Block::getInstance()->getBlocksForNode($nodeId)])
			);
		}
	}
}
