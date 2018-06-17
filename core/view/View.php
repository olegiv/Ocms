<?php

namespace Ocms\core\view;

use Ocms\core\Kernel;

/**
 * Description of View
 *
 * @author olegiv
 */
class View extends ViewBase {
	
	const CACHE_DEFAULT_PATH = 'data/cache';
	
	const TWIG_DEFAULT_PATH = 'templates/default/twig';

	/**
	 *
	 * @var View This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var 
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
	 * 
	 */
	private function __construct() {
		
		$this->conf = Kernel::$configurationObj->getConfigurationGlobal();
		$loader = new \Twig_Loader_Filesystem ($this->getTwigPath());
		$this->twigObj = new \Twig_Environment ($loader, $this->getTwigOptions());
	}
	
	/**
	 * 
	 * @return string
	 */
	private function getTwigPath (): string {
		
		if (isset($this->conf->Layout->template->id)) {
			$twigPath = 'templates/' . $this->conf->Layout->template->id . '/twig';
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
		if (isset ($this->conf->Site->cache->enabled) && $this->conf->Site->cache->enabled) {
			if (isset($this->conf->Site->cache->path)) {
				$twigOptions['cache'] = $this->conf->Site->cache->path;
			} else {
				$twigOptions['cache'] = self::CACHE_DEFAULT_PATH; // 'cache' => 'data/cache',
			}
		}
		return $twigOptions;
	}

	/**
	 * 
	 * @param string $template
	 * @param array $params
	 * @return string
	 */
	public function render (string $template, array $params = []): string {

		try {
			$html = $this->twigObj->render($template . '.html.twig', $params);
		} catch (\Exception $e) {
			Kernel::$logObj->log($e->getMessage ());
			$html = '';
		}
		return $html;
	}

}
