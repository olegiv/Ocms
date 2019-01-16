<?php

namespace Ocms\core\controller;

/**
 * FrontControllerInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface FrontControllerInterface {

  /**
   * @param int $nodeId
   * @return mixed
   */
	public function viewAction (int $nodeId);

}
