<?php

namespace Ocms\core\app\form\service\field;

/**
 * FieldHiddenService Class.
 *
 * @package core
 * @access public
 * @since 15.02.2019
 * @version 0.0.0 15.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class FieldHiddenService extends FieldAbstractService implements FieldAbstractServiceInterface {

	/**
	 * @var string
	 */
	protected $fieldType = FieldsService::FIELD_HIDDEN;
}
