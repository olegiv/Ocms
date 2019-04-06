<?php

namespace Ocms\core\app\tag\service;

/**
 * TagEntityInterface Interface.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.1 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
interface TagEntityInterface {

	/**
	 * @param int $id
	 * @return array
	 */
	public function get (int $id): array;

	/**
	 * @param string $label
	 * @return \stdClass
	 */
	public function getByLabel (string $label);

	/**
	 * @param string $label
	 * @return int
	 */
	public function add (string $label): int;
}
