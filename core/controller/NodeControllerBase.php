<?php

namespace Ocms\core\controller;

/**
 * NodeControllerBase Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
abstract class NodeControllerBase extends ControllerBase implements ControllerInterface {

	/**
	 *
	 */
	protected function __construct() {}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId) {}

}
