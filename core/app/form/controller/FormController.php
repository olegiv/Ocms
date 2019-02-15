<?php

namespace Ocms\core\app\form\controller;

use Ocms\core\app\form\service\FormService;
use Ocms\core\controller\ControllerBase;

/**
 * FormController Class.
 *
 * @package core
 * @access public
 * @since 14.02.2019
 * @version 0.0.0 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class FormController extends ControllerBase implements FormControllerInterface {

	/**
	 * 
	 */
	public function __construct() {}

	/**
	 * @param array $formProperties
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public static function getHtml (array $formProperties): string {

		$formObj = new FormService($formProperties);
		$return = $formObj->getHtml($formProperties);
		return $return;
	}
}
