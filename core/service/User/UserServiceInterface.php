<?php

namespace Ocms\core\service\User;

/**
 * Description of ConfigurationService
 *
 * @author olegiv
 */
interface UserServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\User\UserService
	 */
  public static function getInstance(): UserService; 
	

	
}
