<?php

namespace Ocms\core\app\form\service\field;

use Ocms\core\exception\ExceptionBase;
use Ocms\core\exception\ExceptionRuntime;

/**
 * FieldsService Class.
 *
 * @package core
 * @access public
 * @since 15.02.2019
 * @version 0.0.0 15.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class FieldsService implements FieldsServiceInterface {

	const FIELD_TEXT = 'text';
	const FIELD_HIDDEN = 'hidden';
	const FIELD_BUTTON = 'button';

	/**
	 * @var array
	 */
	private $fields;

	/**
	 * FieldsService constructor.
	 * @param array $fields
	 * @throws ExceptionRuntime
	 */
	public function __construct(array $fields) {

		$this->fields = $fields;
		$this->prepareFields();
	}

	/**
	 * @throws ExceptionRuntime
	 */
	private function prepareFields () {

		if ($this->fields) {
			foreach ($this->fields as $key => $field) {
				if (! isset($field['id'])) {
					if (isset($field['name'])) {
						$this->fields[$key]['id'] = $field['name'];
					} else {
						throw new ExceptionRuntime (ExceptionBase::E_FATAL, t('Field ID and name empty'));
					}
				}
			}
		}
	}

	/**
	 * @return string
	 * @throws ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public function getHtml (): string {

		$return = '';
		if ($this->fields) {
			foreach ($this->fields as $field) {
				if (! isset($field['type']) || ! $field['type']) {
					throw new ExceptionRuntime (ExceptionBase::E_FATAL,
						t('Empty field type for field: %s', $field['id']));
				}
				switch ($field['type']) {
					case self::FIELD_TEXT:
						$fieldObj = new FieldTextService($field);
						$return .= $fieldObj->getHtml();
						break;
					case self::FIELD_HIDDEN:
						$fieldObj = new FieldHiddenService($field);
						$return .= $fieldObj->getHtml();
						break;
					case self::FIELD_BUTTON:
						$fieldObj = new FieldButtonService($field);
						$return .= $fieldObj->getHtml();
						break;

					default:
						throw new ExceptionRuntime (ExceptionBase::E_FATAL,
							t('Bad field type %s for field %s', $field['type'], $field['id']));
				}
			}
		}
		return $return;
	}
}
