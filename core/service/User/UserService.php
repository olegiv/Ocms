<?php

namespace Ocms\core\service\User;

use Ocms\core\model\UserModel;

/**
 * UserService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class UserService implements UserServiceInterface {

	/**
	 *
	 * @var UserService This class instance
	 */
	static $_instance;

  /**
   * @return UserService
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

  /**
   * @param int $userId
   * @return string
   */
	public static function getUserName(int $userId): string {
		
		return UserModel::getUserName($userId);
	}
}
