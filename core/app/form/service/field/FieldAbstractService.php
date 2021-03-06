<?php

namespace Ocms\core\app\form\service\field;

use Ocms\core\app\form\service\FormService;
use Ocms\core\view\Twig;

/**
 * FieldAbstractService Class.
 *
 * @package core
 * @access public
 * @since 15.02.2019
 * @version 0.0.1 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
abstract class FieldAbstractService implements FieldAbstractServiceInterface {

	/**
	 * @var string
	 */
	protected $fieldType;

	/**
	 * @var array
	 */
	protected $properties;

	/**
	 * FieldHiddenService constructor.
	 * @param array $formProperties
	 */
	public function __construct(array $formProperties) {

		$this->properties = $formProperties;
	}

	/**
	 * @return string
	 */
	public function getHtml (): string {

		$return = Twig::renderCoreAppTemplate(
			FormService::APP, 'field/' . $this->fieldType, $this->properties);
		return $return;
	}
}
