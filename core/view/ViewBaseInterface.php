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
	 * @param string $template
	 */
	public function render(string $template);
	
}
