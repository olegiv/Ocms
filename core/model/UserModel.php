<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * Description of UserModel
 *
 * @author olegiv
 */
class UserModel {
	
	public static function getUserName(int $userId): string {

		return Kernel::$modelObj->shift('SELECT username FROM #prefix#user WHERE id=?', $userId);
	}

}
