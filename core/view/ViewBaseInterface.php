<?php

namespace Ocms\core\view;

/**
 * ViewBaseInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.3 12.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface ViewBaseInterface {

  /**
   * @param string $template
   * @param array $params
   * @return string
   */
	public function render(string $template, array $params = []): string;

	/**
	 * @param string $template
	 * @return bool
	 */
	public static function isTemplateValid (string $template): bool;
}
