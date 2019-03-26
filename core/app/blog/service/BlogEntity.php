<?php

namespace Ocms\core\app\blog\service;

use Ocms\core\app\blog\model\BlogModel;

/**
 * BlogEntity Class.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.0 26.03.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class BlogEntity implements BlogEntityInterface {

	/**
	 * 
	 */
	public function __construct () {}

	/**
	 * @param int $id
	 * @return \stdClass
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function get (int $id): \stdClass {

		return BlogModel::get($id);
	}

	/**
	 * @param \stdClass $item
	 * @return int
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function add (\stdClass $item): int {

		return BlogModel::add ($item);
	}
}
