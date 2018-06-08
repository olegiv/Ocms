<?php

//namespace Ocms\core\service\Configuration;
namespace Ocms\core\service\Configuration;

/**
 * Description of ConfigurationService
 *
 * @author olegiv
 */
class ConfigurationService implements ConfigurationServiceInterface {
	
	/**
	 *
	 * @var ConfigurationService This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var  
	 */
	private $configurationGlobal;
	
	/**
	 * 
	 * @return ConfigurationService
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
	 * @return type
	 * @throws \Exception
	 */
	private function loadConfigurationGlobal() {
		
		try {
			if (! ($confJson = file_get_contents ('conf/global.json'))) {
				throw new \Exception(t('Cannot open global configuration file: ') . $e->getMessage());
			}
			if (! ($this->configurationGlobal = json_decode ($confJson))) {
				throw new \Exception(t('Cannot parse global configuration: ') . $e->getMessage());
			}
			return $this->configurationGlobal;
		} catch (\Exception $e) {
			die (t('Cannot load global configuration: ') . $e->getMessage());
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
			$homePageId = 0;
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
	 */
	public function getConfigurationGlobal() {
		
	}

}
