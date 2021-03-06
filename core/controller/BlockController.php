<?php

namespace Ocms\core\controller;

use Ocms\core\Kernel;

/**
 * BlockController Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class BlockController extends NodeControllerBase implements ControllerBaseInterface {
	
	const BLOG_LIST = 'BLOG_LIST';

	/**
	 *
	 * @var BlockController This class instance
	 */
	static $_instance;

	/**
	 * 
	 * @return BlockController
	 */
  public static function getInstance(): BlockController {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * @param string $controllerId
   * @return string
   */
	public function renderController (string $controllerId): string {
		
		switch ($controllerId) {
			case self::BLOG_LIST:
				$html = Kernel::$blogControllerObj->renderList();
				break;
			default:
				Kernel::$logObj->log(t('Bad controller ID: %s', $controllerId));
				$html = '';
		}
		return $html;
	}
}
