<?php

namespace Ocms\app\example\controller;

use Ocms\core\app\form\service\field\FieldsService;
use Ocms\core\app\form\service\FormService;
use Ocms\core\controller\ControllerBase;
use Ocms\core\controller\ControllerBaseInterface;

/**
 * ExampleFormController Class.
 *
 * @package core
 * @access public
 * @since 14.02.2019
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class ExampleFormController extends ControllerBase implements ControllerBaseInterface {

	/**
	 * @var array
	 */
	private static $formProperties = [
		'title' => 'My Form #1',
		'fields' => [
			['name' => 'field1', 'type' => FieldsService::FIELD_TEXT, 'label' => 'Field1'],
			['name' => 'OK', 'type' => FieldsService::FIELD_BUTTON, 'label' => 'OK']
		]
	];

	/**
	 *
	 */
	public static function display () {

		$formObj = new FormService(self::$formProperties);
		$result = $formObj->run();
		if ($result) {
			$formObj->displayFinalMessage('Thank you! You entered: ' . print_r($result, true));
		}
	}
}
