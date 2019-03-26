<?php

namespace Ocms\core\app\tag\service;

use Ocms\core\app\tag\model\TagModel;

/**
 * TagEntity Class.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.0 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class TagEntity implements TagEntityInterface {

	/**
	 * 
	 */
	public function __construct () {}

	/**
	 * @param int $id
	 * @return array
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function get (int $id): array {

		return TagModel::get($id);
	}

	/**
	 * @param string $label
	 * @return \stdClass
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function getByLabel (string $label) {

		$return = TagModel::getBylabel($label);
		return $return;
	}

	/**
	 * @param string $label
	 * @return int
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public function add (string $label): int {

		$return = 0;
		$label = trim ($label);

		if (! $this->getByLabel ($label)) {
			$return = TagModel::add ($label);
		}

		return $return;
	}
}
