<?php

namespace Ocms\core\controller;

use Ocms\core\Kernel;

/**
 * Description of BlockController
 *
 * @author olegiv
 */
class BlockController extends NodeControllerBase implements ControllerInterface {
	
	const BLOG_LIST = 'BLOG_LIST';

	/**
	 *
	 * @var Ocms\core\controller\BlockController This class instance
	 */
	static $_instance;

	/**
	 * 
	 * @return Ocms\core\controller\BlockController
	 */
  public static function getInstance(): BlockController {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
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
