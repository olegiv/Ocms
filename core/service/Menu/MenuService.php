<?php

namespace Ocms\core\service\Menu;

use Ocms\core\Kernel;
use Ocms\core\model\MenuModel;

/**
 * MenuService Class.
 *
 * @package core
 * @access public
 * @since 18.01.2019
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MenuService implements MenuServiceInterface {

	/**
	 *
	 * @var MenuService This class instance
	 */
	static $_instance;

  /**
   * @return MenuService
   */
  public static function getInstance(): MenuService {
  
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
	 * @param int $nodeId
	 * @return string
	 */
	public function getMenuForNodeHtml (int $nodeId): string {

		if (($menu = MenuModel::getMenuForNode($nodeId))) {
			foreach ($menu as $key => $value) {
				if ($nodeId == $value->id2_node) {
					$menu[$key]->current = true;
				} else {
					$menu[$key]->current = false;
				}
			}
		} else {
			$menu = [];
		}

		return Kernel::$viewObj->render ('include/menu/menu',
			['menus' => $menu]
		);
	}

	/**
	 * @return string
	 */
	public function getDefaultMenuHtml (): string {

		if (! ($menu = MenuModel::getMenuForNode (Kernel::$configurationObj->getHomePageId ()))) {
			$menu = [];
		}

		return Kernel::$viewObj->render ('include/menu/menu',
			['menus' => $menu]
		);
	}
}
