<?php

namespace Ocms\core\app\blog\model;

use Ocms\core\Kernel;

/**
 * BlogModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class BlogModel {

	/**
	 * @param int $blogId
	 * @return object
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function get (int $blogId) {

		return Kernel::$modelObj->single('
			SELECT b.id AS id, id2_author, username AS author, thumbnail, title, body, content_date, tags, abstract, description
			FROM /*prefix*/blog b, /*prefix*/user u
			WHERE b.id=? AND u.id = b.id2_author',
			$blogId
		);
	}

	/**
	 * @return array
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getList () {

		return Kernel::$modelObj->fetch('
			SELECT b.id AS id, id2_author, username AS author, thumbnail, title, body, content_date, tags, abstract, description
			FROM /*prefix*/blog b, /*prefix*/user u
			WHERE u.id=b.id2_author
			ORDER BY content_date DESC');
	}

	/**
	 * @param \stdClass $item
	 * @return int
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function add (\stdClass $item): int {

		$return = 0;

		if (Kernel::$modelObj->execute ('
			INSERT INTO /*prefix*/blog
			(id, id2_author, id2_category, title,
			 body, created, content_date, thumbnail,
			 abstract, tags, description)
			 VALUES (?, ?, ?, ?,
			         ?, ?, ?, ?,
			         ?, ?, ?)',
			$item->id, $item->id2_author, $item->id2_category, $item->title,
			$item->body, $item->created, $item->content_date, $item->thumbnail,
			$item->abstract, $item->tags, $item->description))
		{
			$return = Kernel::$modelObj->getLastId ();
		}

		return $return;
	}
}
