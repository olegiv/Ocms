<?php

namespace Ocms\core\controller;

use Ocms\core\service\Parser\ParserService;

/**
 * NodeControllerBase Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 15.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
abstract class NodeControllerBase extends ControllerBase implements ControllerBaseInterface {

	/**
	 *
	 */
	protected function __construct() {}

	/**
	 *
	 * @param int $nodeId
	 */
	public static function viewAction (int $nodeId) {}

	/**
	 * @param \stdClass $node
	 * @return \stdClass
	 */
	protected static function preProcess (\stdClass $node): \stdClass {

		if (isset($node->body) && ! empty($node->body)) {
			$node->body = ParserService::parseHtml($node->body);
		}
		return $node;
	}
}
