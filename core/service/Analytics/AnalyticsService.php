<?php

namespace Ocms\core\service\Analytics;

use Ocms\core\Kernel;

/**
 * Description of Analytics
 *
 * @author olegiv
 */
class AnalyticsService implements AnalyticsServiceInterface {

	/**
	 *
	 * @var Ocms\core\service\Analytics\AnalyticsService This class instance
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
	 *
	 * @return Ocms\core\service\Analytics\AnalyticsService
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

		if (($this->googleTrackerId = Kernel::$configurationObj->getConfigurationGlobal('Analytics')['google'])) {
			$this->googleTrackerCode = sprintf ($this->googleTrackerCode, $this->googleTrackerId, $this->googleTrackerId);
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
