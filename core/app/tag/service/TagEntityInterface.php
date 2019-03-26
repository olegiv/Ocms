<?php

namespace Ocms\core\app\tag\service;

/**
 * TagEntityInterface Interface.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.0 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
interface TagEntityInterface {

	/**
	 * @param int $id
	 * @return array
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function get (int $id): array;

	/**
	 * @param string $label
	 * @return \stdClass
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function getByLabel (string $label);

	/**
	 * @param string $label
	 * @return int
	 */
	public function add (string $label): int;
}
