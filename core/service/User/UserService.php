<?php

namespace Ocms\core\service\User;

use Ocms\core\model\UserModel;

/**
 * Description of ConfigurationService
 *
 * @author olegiv
 */
class UserService implements UserServiceInterface {

	/**
	 *
	 * @var Ocms\core\service\User\UserService This class instance
	 */
	static $_instance;
	
	/**
	 * 
	 * @return Ocms\core\service\User\UserService
	 */
  public static function getInstance(): UserService {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {
		
	}

	public static function getUserName(int $userId): string {
		
		return UserModel::getUserName($userId);
	}

}
