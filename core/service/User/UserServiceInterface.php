<?php

namespace Ocms\core\service\User;

/**
 * UserServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface UserServiceInterface {

  /**
   * @return UserService
   */
  public static function getInstance(): UserService;

  /**
   * @param int $userId
   * @return string
   */
  public static function getUserName(int $userId): string;
}
