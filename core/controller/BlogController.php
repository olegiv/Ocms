<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;
use Ocms\core\model\BlogModel;
use Ocms\core\model\BlockModel;
use Ocms\core\model\UserModel;
use Ocms\core\service\Date\DateService;

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
	private static $_instance;

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
	protected function get(int $nodeId) {

		if (!($blog = BlogModel::getBlog($nodeId))) {
			throw new ExceptionRuntime(ExceptionRuntime::E_NOT_FOUND, t('Cannot load blog: %s', $nodeId));
		}
		return $this->setProperties($blog);
	}
	
	/**
	 * 
	 * @param \stdClass $blog
	 * @return \stdClass
	 */
	private function setProperties($blog) {
		
		$blog->username = UserModel::getUserName($blog->id2_author);
		$blog->content_date = DateService::fromTimestamp($blog->content_date);
		$blog->tagsArray = explode(' ', $blog->tags);
		return $blog;
	}

	/**
	 *
	 * @return array
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	protected function getList() {

		if (!($blogs = BlogModel::getBlogs())) {
			throw new ExceptionRuntime(ExceptionRuntime::E_NOT_FOUND, t('Cannot load blogs'));
		}
		foreach ($blogs as $key => $blog) {
			$blogs[$key] = $this->setProperties($blog);
		}
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
					['blocks' => BlockModel::getBlocksForBlogIndex()],
					['analytics' => Kernel::$analyticsObj->getTrackerHtmlCode()])
			);
		}
	}

	/**
	 * @todo
	 * @return string
	 */
	public static function renderList() {

		if (($blogs = self::$_instance->getList ())) {
			$html = Kernel::$viewObj->render('blogs',	['blogs' => $blogs]);
		} else {
			$html = '';
		}
		return $html;
	}

	/**
	 * 
	 * @param int $nodeId
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	public static function viewAction($nodeId) {

		if (! $nodeIdSanitized = intval($nodeId)) {
			throw new ExceptionRuntime(ExceptionRuntime::E_NOT_FOUND, t('Bad blog ID: %s', $nodeId));
		}
		if (($node = self::$_instance->get($nodeIdSanitized))) {
			echo Kernel::$viewObj->render('extend/blog',
				array_merge((array)$node,
					['blocks' => Kernel::$blockObj->getBlocksForBlog()],
					['analytics' => Kernel::$analyticsObj->getTrackerHtmlCode()])
			);
		}
	}
}
