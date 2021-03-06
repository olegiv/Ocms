<?php

namespace Ocms\core\service\Alias;

use Ocms\core\model\AliasModel;

/**
 * AliasService Class.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.4 30.01.2020
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019 - 2020, OCMS
 */
class AliasService implements AliasServiceInterface {

	/**
	 *
	 * @var AliasService This class instance
	 */
	static $_instance;

  /**
   * @return AliasService
   */
  public static function getInstance(): AliasService {

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
	 * @return array
	 */
	public function getAliases (): array {

		return AliasModel::getAliases();
	}
}
