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
 * @version 0.0.0 18.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MenuService implements MenuServiceInterface {

	/**
	 *
	 * @var \Ocms\core\service\Menu\MenuService This class instance
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
	 * @return array
	 */
	/*private function getMenuForNode(int $nodeId): array {

		return [
			['url' => '/', 'label' => 'Homepage', 'current' => true],
			['url' => '/node/2', 'label' => 'Blogs'],
			['url' => '/node/3', 'label' => 'About']
		];
	}*/

	/**
	 * @param int $nodeId
	 * @return string
	 */
	public function getMenuForNode(int $nodeId): string {

		return Kernel::$viewObj->render ('include/menu/menu',
			['menus' => MenuModel::getMenuForNode($nodeId)]
		);
	}
}
