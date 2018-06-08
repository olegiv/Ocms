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
	 * @return ConfigurationService
	 */
  public static function getInstance(); 
	
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
