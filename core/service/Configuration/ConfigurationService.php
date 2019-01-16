<?php

namespace Ocms\core\service\Configuration;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

use Ocms\core\exception\ExceptionFatal;

/**
 * ConfigurationService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
class ConfigurationService implements ConfigurationServiceInterface {

	const GLOBAL_CONF_FILE = 'conf/global.yaml';

	/**
	 *
	 * @var \Ocms\core\service\Configuration\ConfigurationService This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var array
	 */
	private $configurationGlobal;

  /**
   * @return ConfigurationService
   * @throws ExceptionFatal
   */
  public static function getInstance(): ConfigurationService {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * ConfigurationService constructor.
   * @throws ExceptionFatal
   */
	private function __construct() {

		$this->loadConfigurationGlobal();
	}

  /**
   * @throws ExceptionFatal
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

		return $this->getConfigurationGlobalItem ('DB', 'type');
	}

	/**
	 *
	 * @return int
	 */
	public function getHomePageId (): int {

		return (int)$this->getConfigurationGlobalItem ('Site', 'homepageId');
	}

	/**
	 *
	 * @return int
	 */
	public function getSiteName (): int {

		return $this->getConfigurationGlobalItem ('Site', 'name');
	}

	/**
	 *
	 * @return int
	 */
	public function getErrorPageId (int $errorCode): int {

		return $this->getConfigurationGlobalItem ('Site', 'errorPageIds', (string)$errorCode);
	}

	/**
	 *
	 * @return string
	 */
	public function getDbPrefix (): string {

		return $this->getConfigurationGlobalItem ('DB', 'prefix');
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

	/**
	 *
	 * 1st parameter - configuration section ID
	 * other parameters - other configuration IDs
	 * @return string
	 */
	public function getConfigurationGlobalItem (): string {

		$configurationItem = '';

		list ($section, $ids) = self::prepare (func_get_args ());

		if (isset ($this->configurationGlobal[$section])) {
			if ($ids) {
				$maxId = count ($ids);
				$level = 0;
				$base = $this->configurationGlobal[$section];
				foreach ($ids as $id) {
					if (isset ($base[$id])) {
						$base = $base[$id];
						$level ++;
					} else {
						break;
					}
				}
				if (count ($ids) === $level) {
					$configurationItem = $base;
				}
			}
		}

		return $configurationItem;
	}

	/**
	 *
	 * @param array $args
	 * @return array
	 */
	private static function prepare (array $args): array {

		$section = array_shift ($args);
		$args = self::normalizeArgs ($args);
		return [$section, $args];
	}

  /**
   * @param $args
   * @return array|null
   */
	private static function normalizeArgs ($args) {

		if (count($args) === 0) {
			$return = null;
		} else if (count($args) === 1 && is_object($args[0])) {
			$return = array_values((array) $args[0]);
		} else if (count($args) === 1 && is_array($args[0])) {
			$return = array_values($args[0]);
		} else {
			$return = $args;
		}
		return $return;
	}
}
