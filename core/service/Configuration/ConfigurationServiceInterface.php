<?php

namespace Ocms\core\service\Configuration;

/**
 * Description of ConfigurationService
 *
 * @author olegiv
 */
interface ConfigurationServiceInterface {
	
	/**
	 * 
	 * @return Ocms\core\service\Configuration\ConfigurationService
	 */
  public static function getInstance(): ConfigurationService; 
	
	/**
	 * 
	 * @param string $section
	 * @return \stdClass
	 */
	public function getConfigurationGlobal(string $section = ''): \stdClass;
	
	public function setConfigurationGlobal ();
	
	/**
	 * 
	 * @return string
	 */
	public function getDbType (): string;
	
	/**
	 * 
	 * @return int
	 */
	public function getHomePageId (): int;
		
	/**
	 * 
	 * @return string
	 */
	public function getDbPrefix (): string;
	
}
