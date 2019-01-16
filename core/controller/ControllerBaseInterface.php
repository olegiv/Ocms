<?php

namespace Ocms\core\controller;

/**
 * ControllerBaseInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface ControllerBaseInterface {

	/**
	 *
	 * @param int $nodeId
	 */
	public function viewAction (int $nodeId);

}
