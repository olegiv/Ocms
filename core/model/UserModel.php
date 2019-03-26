<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * UserModel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class UserModel {

	/**
	 * @param int $userId
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function getUserName(int $userId): string {

		return Kernel::$modelObj->shift('SELECT username FROM /*prefix*/user WHERE id=?', $userId);
	}
}
