<?php

namespace Ocms\core\service\Parser;

use Ocms\core\controller\ControllerBase;
use Ocms\core\Kernel;

/**
 * ParserService Class.
 *
 * @package core
 * @access public
 * @since 01.02.2019
 * @version 0.0.1 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class ParserService implements ParserServiceInterface {

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
