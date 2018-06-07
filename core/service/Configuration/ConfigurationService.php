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
	
	private function __construct() {
		
		$this->configurationGlobal = [
			'DB' => [
					'type' => 'sqlite',
					'username' => 'user',
					'password' => 'pass'
			]
		];
	}

	public function getConfigurationGlobal() {
		
		return $this->configurationGlobal;
	}

	public function setConfigurationGlobal() {
		
	}
	
	public function getDbType (): string {
		
		return $this->configurationGlobal['DB']['type'];
	}

}
