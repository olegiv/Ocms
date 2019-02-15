<?php

namespace Ocms\core\app\form\service;

use Ocms\core\app\form\service\field\FieldsService;
use Ocms\core\Kernel;
use Ocms\core\view\Twig;

/**
 * FormService Class.
 *
 * @package core
 * @access public
 * @since 14.02.2019
 * @version 0.0.1 15.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class FormService implements FormServiceInterface {

	/**
	 * @todo Generate it
	 */
	const APP = 'form';

	const FIELD_TOKEN = 'ocms_form';

	/**
	 * @var array
	 */
	private $properties = [];

	/**
	 * Redundant, but just to simplify code.
	 * @var array
	 */
	private $fields = [];

	/**
	 * @var array
	 */
	private $submittedData = [];

	/**
	 * @var array
	 */
	private $fieldToken = [
		'type' => FieldsService::FIELD_HIDDEN, 'name' => self::FIELD_TOKEN, 'value' => 1
	];

	/**
	 * FormService constructor.
	 * @param array $formProperties
	 */
	public function __construct(array $formProperties) {

		$this->properties = $formProperties;
		$this->fields = &$this->properties['fields'];
	}

	/**
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	private function getFieldsHtml (): string {

		$return = '';
		if ($this->properties['fields']) {
			$fieldsObj = new FieldsService($this->properties['fields']);
			$return = $fieldsObj->getHtml();
		}
		return $return;
	}

	/**
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	private function getHtml (): string {

		$this->getData();

		$this->addTokenField();

		$fieldsHtml = $this->getFieldsHtml();
		$return = Twig::renderCoreAppTemplate(self::APP,'form',
			array_merge($this->properties, ['fieldsHtml' => $fieldsHtml]));
		return $return;
	}

	/**
	 *
	 */
	private function addTokenField() {

		$this->fields[] = $this->fieldToken;
	}

	/**
	 * @return bool
	 */
	private function isSubmitted(): bool {

		return $this->validateToken((string)filter_input(
			INPUT_POST, self::FIELD_TOKEN, FILTER_SANITIZE_STRING));
	}

	/**
	 * @param string $token
	 * @return bool
	 */
	private function validateToken(string $token): bool {

		return (bool)$token;
	}

	/**
	 * @return bool
	 */
	private function getData():bool {

		if ($this->isSubmitted()) {
			foreach ($this->fields as $key => $field) {
				if (($submittedValue = filter_input(INPUT_POST, $field['name']))) {
					$this->fields[$key]['value'] = $this->submittedData[$field['name']] = $submittedValue;
				}
			}
			$return = $this->validateData();
		} else {
			$return = true;
		}

		return $return;
	}

	/**
	 * @return bool
	 */
	private function validateData (): bool {

		return true;
	}

	/**
	 * @param string $message
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public function displayFinalMessage(string $message) {

		$html = Twig::renderCoreAppTemplate(self::APP,'form',
			array_merge($this->properties, ['message' => $message]));
		echo $this->render($html);
	}

	/**
	 * @return array
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	public function run(): array {

		$return = [];

		if ($this->isSubmitted()) {
			if ($this->getData()) {
				if ($this->validateData()) {
					$return = $this->submittedData;
				}
			}
		} else {
			$html = $this->getHtml();
			echo $this->render($html);
		}

		return $return;
	}

	/**
	 * @param string $html
	 * @return string
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	private function render (string $html): string {

		return Kernel::$viewObj->render('extend/node', [
			'body' => $html,
			'blocks' => Kernel::$blockObj->getBlocksForForm (),
			'menu' => Kernel::$menuObj->getDefaultMenuHtml (),
			'site' => Kernel::getSiteConfiguration()
		]);
	}
}
