<?php

namespace Ocms\core\app\meta\service;

use Ocms\core\view\Twig;

/**
 * MetaService Class.
 *
 * @package core
 * @access public
 * @since 16.02.2019
 * @version 0.0.0 16.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 201, OCMS
 */
class MetaService implements MetaServiceInterface {

	const APP = 'meta';

	/**
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public static function getGlobalHtml (): string {

		return Twig::renderCoreAppTemplate(self::APP,'global', ['favicon' => self::getFaviconHtml()]);
	}

	private static function getFaviconHtml (): string {

		return Twig::renderCoreAppTemplate(self::APP,'favicon', []);
	}
}
