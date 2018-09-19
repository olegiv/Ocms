<?php

namespace Ocms\core\service\Configuration;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

use Ocms\core\exception\ExceptionFatal;

/**
 * Description of ConfigurationService
 *
 * @author olegiv
 */
class ConfigurationService implements ConfigurationServiceInterface {

	const GLOBAL_CONF_FILE = 'conf/global.yaml';

	/**
	 *
	 * @var Ocms\core\service\Configuration\ConfigurationService This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var
	 */
	private $configurationGlobal;

	/**
	 *
	 * @return Ocms\core\service\Configuration\ConfigurationService
	 */
  public static function getInstance(): ConfigurationService {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

	/**
	 *
	 */
	private function __construct() {

		$this->loadConfigurationGlobal();
	}

	/**
	 *
	 * @throws Ocms\core\exception\ExceptionFatal
	 */
	private function loadConfigurationGlobal() {

		try {
			if (! ($this->configurationGlobal = Yaml::parseFile (self::GLOBAL_CONF_FILE))) {
				throw new ExceptionFatal (ExceptionFatal::E_FATAL,
					'Cannot parse global configuration');
			}
		} catch (ParseException $e) {
			throw new ExceptionFatal (ExceptionFatal::E_FATAL,
				'Cannot parse global configuration, error: ' . $e->getMessage ());
		}
	}

	/**
	 *
	 */
	public function setConfigurationGlobal() {

	}

	/**
	 *
	 * @return string
	 */
	public function getDbType (): string {

		if (isset ($this->configurationGlobal['DB']['type'])) {
			$dbType = $this->configurationGlobal['DB']['type'];
		} else {
			$dbType = '';
		}
		return $dbType;
	}

	/**
	 *
	 * @return int
	 */
	public function getHomePageId (): int {

		if (isset ($this->configurationGlobal['Site']['homepageId'])) {
			$homePageId = (int)$this->configurationGlobal['Site']['homepageId'];
		} else {
			$homePageId = 1;
		}
		return $homePageId;
	}

	/**
	 *
	 * @return string
	 */
	public function getDbPrefix (): string {

		if (isset ($this->configurationGlobal['DB']['prefix'])) {
			$dbPrefix = $this->configurationGlobal['DB']['prefix'];
		} else {
			$dbPrefix = '';
		}
		return $dbPrefix;
	}

	/**
	 *
	 * @param string $section
	 * @return array
	 */
	public function getConfigurationGlobal (string $section = ''): array {

		if ($section && isset($this->configurationGlobal[$section])) {
			$configuration = $this->configurationGlobal[$section];
		} else {
			$configuration = $this->configurationGlobal;
		}
		return $configuration;
	}

}
