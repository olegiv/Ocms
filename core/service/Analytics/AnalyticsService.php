<?php

namespace Ocms\core\service\Analytics;

use Ocms\core\Kernel;

/**
 * AnalyticsService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
class AnalyticsService implements AnalyticsServiceInterface {

	/**
	 *
	 * @var \Ocms\core\service\Analytics\AnalyticsService This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var string
	 */
	private $googleTrackerId;

	/**
	 *
	 * @var string
	 */
	private $googleTrackerCode = '<!-- Global site tag (gtag.js) - Google Analytics -->
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
	private function __construct() {

		if (($this->googleTrackerId = Kernel::$configurationObj->getConfigurationGlobalItem ('Analytics', 'google'))) {
			$this->googleTrackerCode = str_replace ('%s', $this->googleTrackerId, $this->googleTrackerCode);
		} else {
			$this->googleTrackerCode = '';
		}
	}

	/**
	 *
	 * @return string
	 */
	public function getTrackerHtmlCode(): string {

		return $this->googleTrackerCode;
	}
}
