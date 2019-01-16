<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * BlogModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
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
