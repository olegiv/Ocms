<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * UserModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class UserModel {

	/**
	 * @param int $userId
	 * @return string
	 */
	public static function getUserName(int $userId): string {

		return Kernel::$modelObj->shift('SELECT username FROM /*prefix*/user WHERE id=?', $userId);
	}
}
