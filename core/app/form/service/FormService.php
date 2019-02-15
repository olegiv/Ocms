<?php

namespace Ocms\core\app\form\service;

use Ocms\core\view\Twig;

/**
 * FormService Class.
 *
 * @package core
 * @access public
 * @since 14.02.2019
 * @version 0.0.0 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class FormService implements FormServiceInterface {

	const APP = 'form';

	/**
	 * @var array
	 */
	private $properties;

	public function __construct(array $formProperties) {

		$this->properties = $formProperties;
	}

	/**
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public function getHtml (): string {

		$return = Twig::renderCoreAppTemplate(self::APP, 'form', $this->properties);
		return $return;
	}
}
