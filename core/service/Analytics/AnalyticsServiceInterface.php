<?php

namespace Ocms\core\service\Analytics;

/**
 * AnalyticsServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
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
	public function getTrackerHtmlCode(): string;
}
