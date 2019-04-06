<?php

namespace Ocms\core\app\tag\model;

use Ocms\core\Kernel;

/**
 * TagModel Class.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.1 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class TagModel {

	/**
	 * @param int $id
	 * @return array
	 */
	public static function get (int $id): array {

		return (array)Kernel::$modelObj->single ('SELECT * FROM /*prefix*/tag WHERE id=?', $id);
	}

	/**
	 * @param string $label
	 * @return \stdClass
	 */
	public static function getByLabel (string $label) {

		return Kernel::$modelObj->single ('SELECT * FROM /*prefix*/tag WHERE label=?', $label);
	}

	/**
	 * @param string $label
	 * @return int
	 */
	public static function add (string $label): int {

		$return = 0;

		if (Kernel::$modelObj->execute ('INSERT INTO /*prefix*/tag (label) VALUES (?)', $label)) {
			$return = Kernel::$modelObj->getLastId ();
		}

		return $return;
	}
}
