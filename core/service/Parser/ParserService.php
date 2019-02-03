<?php

namespace Ocms\core\service\Parser;

use Ocms\core\controller\ControllerBase;
use Ocms\core\Kernel;
use Ocms\core\model\AliasModel;
use Ocms\core\view\Twig;

/**
 * ParserService Class.
 *
 * @package core
 * @access public
 * @since 01.02.2019
 * @version 0.0.0 08.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class ParserService implements ParserServiceInterface {

	/**
	 *
	 * @var \Ocms\core\service\Parser\ParserService This class instance
	 */
	//static $_instance;

  /**
   * @return ParserService
   */
  /*public static function getInstance(): ParserService {
  
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }*/
	
	/**
	 * 
	 */
	//private function __construct() {}

	/**
	 * @param string $html
	 * @return string
	 */
	public static function parseHtml (string $html): string {

		$html_processed = preg_replace_callback(
			'#\<ocms:controller\>(.+?)\<\/ocms:controller\>#s',
			function($matches) {
				$return = '';
				if (($controllerWithMethod = htmlentities($matches[1]))) {
					if (ControllerBase::validateControllerWithMethod($controllerWithMethod)) {
						if (Kernel::inDebug()) {
							$return .= NEW_LINE . '<!-- Controller begin: ' . $controllerWithMethod . ' -->' . NEW_LINE;
						}
						$return .= call_user_func ($controllerWithMethod);
						if (Kernel::inDebug()) {
							$return .= NEW_LINE . '<!-- Controller end: ' . $controllerWithMethod . ' -->' . NEW_LINE;
						}
					}
				}
				return $return;
			},
			$html
		);
		return $html_processed;
	}
}
