<?php

namespace Ocms\core\app\meta\controller;

use Ocms\core\app\meta\service\MetaService;
use Ocms\core\controller\ControllerBase;
use Ocms\core\controller\ControllerBaseInterface;

/**
 * MetaController Class.
 *
 * @package core
 * @access public
 * @since 16.02.2019
 * @version 0.0.0 16.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MetaController extends ControllerBase implements ControllerBaseInterface {

	/**
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public static function getGlobalHtml(): string {

		return MetaService::getGlobalHtml();
	}
}
