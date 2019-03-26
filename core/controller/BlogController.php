<?php

namespace Ocms\core\controller;

use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;
use Ocms\core\app\blog\model\BlogModel;
use Ocms\core\model\UserModel;
use Ocms\core\service\Date\DateService;

/**
 * BlogController Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.5 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class BlogController extends NodeControllerBase implements ControllerBaseInterface {

	/**
	 *
	 * @var \Ocms\core\controller\BlogController This class instance
	 */
	private static $_instance;

	/**
	 *
	 * @return \Ocms\core\controller\BlogController
	 */
  public static function getInstance(): BlogController {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * @param int $nodeId
   * @return \stdClass
   * @throws ExceptionRuntime
   */
	protected function get (int $nodeId) {

		if (!($blog = BlogModel::get ($nodeId))) {
			throw new ExceptionRuntime(ExceptionRuntime::E_NOT_FOUND, t('Cannot load blog: %s', $nodeId));
		}
		return $this->setProperties($blog);
	}

	/**
	 * @param $blog
	 * @return mixed
	 */
	private function setProperties($blog) {

		//$blog->username = UserModel::getUserName ($blog->id2_author);
		$blog->content_date = DateService::formatDateLong ($blog->content_date);
		//$blog->tagsArray = explode (' ', $blog->tags);
		if (! $blog->thumbnail) {
			$blog->thumbnail = '/templates/default/img/logo/logo.svg';
		}
		return $blog;
	}

	/**
	 * @return array
	 * @throws ExceptionRuntime
	 */
	protected function getList() {

		if (!($blogs = BlogModel::getList())) {
			throw new ExceptionRuntime(ExceptionRuntime::E_NOT_FOUND, t('Cannot load blogs'));
		}
		foreach ($blogs as $key => $blog) {
			$blogs[$key] = $this->setProperties($blog);
		}
		return $blogs;
	}

  /**
   * @throws ExceptionRuntime
   */
	/*public static function indexAction () {

		if (($blogs = Kernel::$blogControllerObj->getList ())) {
			echo Kernel::$viewObj->render ('blogs',
				array_merge (
					['blogs' => $blogs],
					['blocks' => BlockModel::getBlocksForBlogIndex()],
					['analytics' => Kernel::$analyticsObj->getTrackerHtmlCode()])
			);
		}
	}*/

	/**
	 * @todo
	 * @return string
   * @throws ExceptionRuntime
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
   * @param int $nodeId
   * @return mixed|void
   * @throws ExceptionRuntime
   */
	public static function viewAction (int $nodeId) {

		if (! $nodeIdSanitized = intval ($nodeId)) {
			throw new ExceptionRuntime (ExceptionRuntime::E_NOT_FOUND, t('Bad blog ID: %s', $nodeId));
		}
		if (($node = self::$_instance->get ($nodeIdSanitized))) {
			echo Kernel::$viewObj->render('extend/blog',
				array_merge ((array)$node, [
					'blocks' => Kernel::$blockObj->getBlocksForBlog (),
					'menu' => Kernel::$menuObj->getMenuForNodeHtml ($nodeId),
					'site' => Kernel::getSiteConfiguration ()
				])
			);
		}
	}
}
