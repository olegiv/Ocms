<?php

namespace Ocms\core\view;

use Ocms\core\controller\ControllerBase;
use Ocms\core\Kernel;

/**
 * Twig Helper View Class.
 *
 * @package core
 * @access public
 * @since 01.02.2019
 * @version 0.0.2 12.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class Twig {

	const CACHE_DEFAULT_PATH = 'data/cache';
	const TWIG_DEFAULT_PATH = 'templates/default';

	/**
	 * @return \Twig_Environment
	 */
	public static function init (): \Twig_Environment {

		$loader = new \Twig_Loader_Filesystem (self::getTwigPath());
		$twigObj = new \Twig_Environment ($loader, self::getTwigOptions());
		if (Kernel::inDebug ()) {
			$twigObj->addExtension(new \Twig_Extension_Debug ());
		}
		self::addFunctions($twigObj);
		return $twigObj;
	}

	/**
	 * @param \Twig_Environment $twigObj
	 */
	private static function addFunctions (\Twig_Environment $twigObj) {

		$function = new \Twig_Function('renderController', function ($controllerWithMethod, $param) {
			if (Kernel::inDebug()) {
				echo NEW_LINE . '<!-- Controller begin: ' . $controllerWithMethod . ' -->' . NEW_LINE;
			}
			if (ControllerBase::validateControllerWithMethod($controllerWithMethod)) {
				call_user_func ($controllerWithMethod, $param);
			}
			if (Kernel::inDebug()) {
				echo NEW_LINE . '<!-- Controller end: ' . $controllerWithMethod . ' -->' . NEW_LINE;
			}
		});
		$twigObj->addFunction($function);

		$function = new \Twig_Function('renderBlockById', function ($blockId) {
			if (Kernel::inDebug()) {
				echo NEW_LINE . '<!-- Block begin: ' . $blockId . ' -->' . NEW_LINE;
			}
			echo Kernel::$blockObj->renderBlockById($blockId);
			if (Kernel::inDebug()) {
				echo NEW_LINE . '<!-- Block end: ' . $blockId . ' -->' . NEW_LINE;
			}
		});
		$twigObj->addFunction($function);
	}

	/**
	 *
	 * @return string
	 */
	private static function getTwigPath (): string {

		if (($template_id = View::getTemplateId ())) {
			$twigPath = 'templates/' . $template_id;
		} else {
			$twigPath = self::TWIG_DEFAULT_PATH;
		}
		return $twigPath;
	}

	/**
	 *
	 * @return array
	 */
	private static function getTwigOptions (): array {

		$twigOptions = [];
		$cacheOptions = Kernel::$configurationObj->getConfigurationGlobalItem('Site', 'cache');
		if (isset ($cacheOptions['enabled']) && $cacheOptions['enabled']) {
			if (isset ($cacheOptions['path'])) {
				$twigOptions['cache'] = $cacheOptions['path'];
			} else {
				$twigOptions['cache'] = self::CACHE_DEFAULT_PATH; // 'cache' => 'data/cache',
			}
		}
		if (Kernel::inDebug ()) {
			$twigOptions['debug'] = true;
		}
		return $twigOptions;
	}

	/**
	 * @param string $template
	 * @param array $params
	 * @return string
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public static function renderStringTemplate (string $template, array $params): string {

		$twigObj = Kernel::$viewObj->getTwigObj();
		$template = $twigObj->createTemplate($template);
		return $template->render($params);
	}
}
