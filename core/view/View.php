<?php

namespace Ocms\core\view;

use Ocms\core\Kernel;

/**
 * View Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 31.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class View extends ViewBase {

	const CACHE_DEFAULT_PATH = 'data/cache';

	const TWIG_DEFAULT_PATH = 'templates/default';

	/**
	 *
	 * @var View This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var array
	 */
	private $conf;

	/**
	 *
	 * @var \Twig_Environment
	 */
	private $twigObj;

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

		$this->conf = Kernel::$configurationObj->getConfigurationGlobal();
		$loader = new \Twig_Loader_Filesystem ($this->getTwigPath());
		$this->twigObj = new \Twig_Environment ($loader, $this->getTwigOptions());
		if (Kernel::inDebug ()) {
			$this->twigObj->addExtension(new \Twig_Extension_Debug ());
		}
	}

	/**
	 *
	 * @return string
	 */
	private function getTwigPath (): string {

		if (isset($this->conf['Layout']['template']['id'])) {
			$twigPath = 'templates/' . $this->conf['Layout']['template']['id'];
		} else {
			$twigPath = self::TWIG_DEFAULT_PATH;
		}
		return $twigPath;
	}

	/**
	 *
	 * @return array
	 */
	private function getTwigOptions (): array {

		$twigOptions = [];
		if (isset ($this->conf['Site']['cache']['enabled']) && $this->conf['Site']['cache']['enabled']) {
			if (isset ($this->conf['Site']['cache']['path'])) {
				$twigOptions['cache'] = $this->conf['Site']['cache']['path'];
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
   */
	public function render (string $template, array $params = []): string {

		try {
			$params['titleHead'] = self::getTitle ($params);
			if (Kernel::inDebug ()) {
				$params['twigFile'] = $template;
			}
			$params = array_merge($params,
							['template_root' => '/templates/' . $this->conf['Layout']['template']['id'] . '/']);
			$html = $this->twigObj->render($template . '.html.twig', $params);
		} catch (\Exception $e) {
			Kernel::$logObj->log($e->getMessage ());
			$html = '';
		}

		if (Kernel::inDebug ()) {
			$html = '<!-- Template start: ' . $template . '-->' . NEW_LINE .
				$html . '<!-- Template end: ' . $template . '-->' . NEW_LINE;
		}

		return $html;
	}



	/**
	 *
	 * @param array $params
	 * @return string
	 */
	private static function getTitle (array $params): string {

		if (isset($params['site']['name'])) {
			$return = $params['title'] . ' | ' . $params['site']['name'];
		} else if (isset($params['title'])) {
			$return = $params['title'];
		} else {
			$return = '';
		}
		return $return;
	}
}
