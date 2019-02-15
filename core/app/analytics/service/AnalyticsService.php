<?php

namespace Ocms\core\app\analytics\service;

use Ocms\core\Kernel;

/**
 * AnalyticsService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 14.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class AnalyticsService implements AnalyticsServiceInterface {

	/**
	 *
	 * @var AnalyticsService This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var string
	 */
	private static $googleTrackerCode = '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=%s"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag(\'js\', new Date());

  gtag(\'config\', \'%s\');
</script>';

  /**
   * @return AnalyticsService
   */
  public static function getInstance(): AnalyticsService {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

	/**
	 *
	 */
	private function __construct() {}

	/**
	 *
	 * @return string
	 */
	public static function getTrackerHtmlCode(): string {

		if (($googleTrackerId = Kernel::$configurationObj->getConfigurationGlobalItem ('Analytics', 'google'))) {
			$googleTrackerCode = str_replace ('%s', $googleTrackerId, self::$googleTrackerCode);
		} else {
			$googleTrackerCode = '';
		}

		return $googleTrackerCode;
	}
}
