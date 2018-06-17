<?php

namespace Ocms\core\service\Configuration;

use Ocms\core\exception\ExceptionFatal;

/**
 * Description of ConfigurationService
 *
 * @author olegiv
 */
class ConfigurationService implements ConfigurationServiceInterface {

	const GLOBAL_CONF_FILE = 'conf/global.json';
	
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
		
		if (! ($confJson = file_get_contents (self::GLOBAL_CONF_FILE))) {
			throw new ExceptionFatal (ExceptionFatal::E_FATAL,
				t('Cannot open global configuration file'));
		}
		if (! ($this->configurationGlobal = json_decode ($confJson))) {
			throw new ExceptionFatal (ExceptionFatal::E_FATAL,
				t ('Cannot parse global configuration'));
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
		
		if (isset($this->configurationGlobal->DB->type)) {
			$dbType = $this->configurationGlobal->DB->type;
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
		
		if (isset($this->configurationGlobal->Site->homepageId)) {
			$homePageId = (int)$this->configurationGlobal->Site->homepageId;
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
		
		if (isset($this->configurationGlobal->DB->prefix)) {
			$dbPrefix = $this->configurationGlobal->DB->prefix;
		} else {
			$dbPrefix = '';
		}
		return $dbPrefix;
	}

	/**
	 * 
	 * @param string $section
	 * @return \stdClass
	 */
	public function getConfigurationGlobal(string $section = ''): \stdClass {
		
		if ($section && isset($this->configurationGlobal->{$section})) {
		$configuration = $this->configurationGlobal->{$section};
		} else {
			$configuration = $this->configurationGlobal;
		}
		return $configuration;
	}

}
