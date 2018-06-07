<?php

namespace Ocms\core\view;

/**
 * Description of View
 *
 * @author olegiv
 */
interface ViewBaseInterface {
	
	/**
	 * 
	 */
	public function init();

	/**
	 * 
	 * @param string $template
	 */
	public function render(string $template);
	
}
