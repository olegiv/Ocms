<?php

namespace Ocms\app\example\controller;

use Ocms\core\app\form\controller\FormController;
use Ocms\core\app\form\controller\FormControllerInterface;
use Ocms\core\Kernel;

/**
 * ExampleFormController Class.
 *
 * @package core
 * @access public
 * @since 14.02.2019
 * @version 0.0.0 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class ExampleFormController extends FormController implements FormControllerInterface {

	/**
	 * @var string
	 */
	private static $body;

	/**
	 * @var array
	 */
	private static $formProperties = [
		'title' => 'My Forms'
	];

	public static function display () {

		$html = FormController::getHtml(self::$formProperties);

		self::render($html);
	}

	/**
	 * @param string $html
	 */
	public static function render (string $html) {

			echo Kernel::$viewObj->render('extend/node', [
				'body' => $html,
				'blocks' => Kernel::$blockObj->getBlocksForForm (),
				'menu' => Kernel::$menuObj->getDefaultMenuHtml (),
				'site' => Kernel::getSiteConfiguration()
			]);
	}
}
