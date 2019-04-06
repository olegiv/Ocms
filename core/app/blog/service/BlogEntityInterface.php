<?php

namespace Ocms\core\app\blog\service;

/**
 * BlogEntityInterface Interface.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.1 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
interface BlogEntityInterface {

	/**
	 * @param int $id
	 * @return \stdClass
	 */
	public function get (int $id): \stdClass;

	/**
	 * @param \stdClass $item
	 * @return int
	 */
	public function add (\stdClass $item): int;
}
