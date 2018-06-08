<?php

namespace Ocms\core\view;

/**
 * Description of ViewBase
 *
 * @author olegiv
 */
abstract class ViewBase implements ViewBaseInterface {
	
	/**
	 *
	 * @var 
	 */
	private $conf;
	
	/**
	 *
	 * @var string
	 */
	private $templatesPath = 'templates/default/twig';
	
}
