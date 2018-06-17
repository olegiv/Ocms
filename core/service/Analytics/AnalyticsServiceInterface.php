<?php

namespace Ocms\core\service\Analytics;

/**
 *
 * @author olegiv
 */
interface AnalyticsServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\Analytics\AnalyticsService
	 */
  public static function getInstance(): AnalyticsService;
	
	/**
	 * 
	 * @return string
	 */
	public function getTrackerHtmlCode(): string;
}
