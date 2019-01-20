<?php

namespace Ocms\core\service\Alias;

/**
 * AliasServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.0 18.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
interface AliasServiceInterface {

  /**
   * @return AliasService
   */
  public static function getInstance(): AliasService;

}
