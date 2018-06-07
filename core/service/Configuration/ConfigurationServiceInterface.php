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
	
	public function getConfigurationGlobal ();
	
	public function setConfigurationGlobal ();
	
	public function getDbType (): string;
}
