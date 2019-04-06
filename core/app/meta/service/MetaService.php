<?php

namespace Ocms\core\app\meta\service;

use Ocms\core\view\Twig;

/**
 * MetaService Class.
 *
 * @package core
 * @access public
 * @since 16.02.2019
 * @version 0.0.1 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MetaService implements MetaServiceInterface {

	const APP = 'meta';

	/**
	 * @return string
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\SyntaxError
	 */
	public static function getGlobalHtml (): string {

		return Twig::renderCoreAppTemplate(self::APP,'global', ['favicon' => self::getFaviconHtml()]);
	}

	/**
	 * @return string
	 * @throws \Twig\Error\LoaderError
	 * @throws \Twig\Error\SyntaxError
	 */
	private static function getFaviconHtml (): string {

		return Twig::renderCoreAppTemplate(self::APP,'favicon', []);
	}
}
