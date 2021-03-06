<?php

namespace Ocms\core\app\analytics\controller;

use Ocms\core\app\analytics\service\AnalyticsService;
use Ocms\core\controller\ControllerBase;
use Ocms\core\controller\ControllerBaseInterface;

/**
 * AnalyticsController Class.
 *
 * @package core
 * @access public
 * @since 14.02.2019
 * @version 0.0.1 15.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class AnalyticsController extends ControllerBase implements ControllerBaseInterface {

	/**
	 * @return string
	 */
	public static function getTrackerHtmlCode() {

		return AnalyticsService::getTrackerHtmlCode();
	}
}
