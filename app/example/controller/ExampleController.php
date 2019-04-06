<?php

namespace Ocms\app\example\controller;

use Ocms\core\controller\ControllerBase;
use Ocms\core\controller\ControllerBaseInterface;
use Ocms\core\view\Twig;

/**
 * ExampleController Class.
 *
 * @package core
 * @access public
 * @since 01.02.2019
 * @version 0.0.3 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class ExampleController extends ControllerBase implements ControllerBaseInterface {

	/**
	 * @param string $data
	 */
	public static function view(string $data) {

		echo $data;
	}

	/**
	 * @return string
	 */
	public static function withoutParams():string {

		return Twig::renderStringTemplate('<strong>{{ possum }}</strong>', ['possum' => 'Opossum']);
	}
}
