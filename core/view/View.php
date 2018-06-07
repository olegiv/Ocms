<?php

namespace Ocms\core\view;

/**
 * Description of View
 *
 * @author olegiv
 */
class View extends ViewBase {

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

		$loader = new \Twig_Loader_Filesystem('templates/default');
		$this->twigObj = new \Twig_Environment($loader, []);
		//'cache' => 'data/cache',
	}
	
	/**
	 * 
	 */
	public function init() {
		
		
	}

	/**
	 * 
	 * @param string $template
	 * @param array $params
	 * @return string
	 */
	public function render(string $template, array $params = []): string {

		return $this->twigObj->render($template . '.html.twig', $params);
	}

}
