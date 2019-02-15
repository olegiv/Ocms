<?php

namespace Ocms\core\view;

use Ocms\core\Kernel;

/**
 * View Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.6 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class View extends ViewBase {

	const TEMPLATES_DIR = '/templates/';

	/**
	 *
	 * @var View This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var \Twig_Environment
	 */
	private $twigObj;

	/**
	 * @var string
	 */
	private static $templatesRoot;

	/**
	 *
	 * @return View
	 */
	public static function getInstance(): View {

		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * View constructor.
	 */
	private function __construct() {

		$this->twigObj = Twig::init();
		self::$templatesRoot = self::TEMPLATES_DIR . self::getTemplateId () . '/';
	}

  /**
   * @param string $template
   * @param array $params
   * @return string
   */
	public function render (string $template, array $params = []): string {

		try {
			$params['titleHead'] = self::getTitle ($params);
			if (Kernel::inDebug ()) {
				$params['twigFile'] = $template;
			}
			$params = array_merge($params,
							['template_root' => self::$templatesRoot]);
			$html = $this->twigObj->render($template . '.html.twig', $params);
		} catch (\Exception $e) {
			Kernel::$logObj->log($e->getMessage ());
			$html = '';
		}

		if (Kernel::inDebug ()) {
			$html = '<!-- Template begin: ' . $template . '-->' . NEW_LINE .
				$html . '<!-- Template end: ' . $template . '-->' . NEW_LINE;
		}

		return $html;
	}

	/**
	 * @return string
	 */
	public static function getTemplateId (): string {

		return Kernel::$configurationObj->getConfigurationGlobalItem ('Layout', 'template', 'id');
	}

	/**
	 *
	 * @param array $params
	 * @return string
	 */
	private static function getTitle (array $params): string {

		if (isset($params['site']['name']) && isset($params['title'])) {
			$return = $params['title'] . ' | ' . $params['site']['name'];
		} else if (isset($params['title'])) {
			$return = $params['title'];
		} else {
			$return = '';
		}
		return $return;
	}

	/**
	 * @return \Twig_Environment
	 */
	public function getTwigObj (): \Twig_Environment {

		return $this->twigObj;
	}

	/**
	 * @param string $template
	 * @return bool
	 */
	public static function isTemplateValid (string $template): bool {

		return file_exists (Kernel::$siteRoot . self::$templatesRoot . $template . '.html.twig');
	}
}
