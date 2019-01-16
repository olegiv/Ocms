<?php

namespace Ocms\core\controller;

/**
 * ControllerBase Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
abstract class ControllerBase implements ControllerBaseInterface {

	/**
	 *
	 * @var int
	 */
	protected $nodeId;

	/**
	 *
	 * @var
	 */
	protected $node;

	/**
	 *
	 */
	protected function getConfig () {

	}

  /**
   * @param int $nodeId
   */
	public function viewAction (int $nodeId) {


	}
}
