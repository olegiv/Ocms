<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * Description of BlogModel
 *
 * @author olegiv
 */
class BlogModel {

	/**
	 *
	 * @param int $blogId
	 * @return \stdClass
	 */
	public static function getBlog (int $blogId) {

		return Kernel::$modelObj->single('SELECT * FROM #prefix#blog WHERE id=?', $blogId);
	}
	
	/**
	 *
	 * @return array
	 */
	public static function getBlogs () {

		return Kernel::$modelObj->fetch('SELECT * FROM #prefix#blog ORDER BY content_date DESC');
	}
}
