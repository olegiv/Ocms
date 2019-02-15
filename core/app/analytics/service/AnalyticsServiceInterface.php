<?php

namespace Ocms\core\app\analytics\service;

/**
 * AnalyticsServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface AnalyticsServiceInterface {

  /**
   * @return AnalyticsService
   */
  public static function getInstance(): AnalyticsService;
	
	/**
	 * 
	 * @return string
	 */
	public static function getTrackerHtmlCode(): string;
}
