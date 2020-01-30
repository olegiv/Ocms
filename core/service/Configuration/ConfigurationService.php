<?php

namespace Ocms\core\service\Configuration;

use Ocms\core\exception\ExceptionRuntime;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;

use Ocms\core\exception\ExceptionFatal;

/**
 * ConfigurationService Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.6 30.01.2020
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2020, OCMS
 */
class ConfigurationService implements ConfigurationServiceInterface {

	const GLOBAL_CONF_FILE = '../conf/config.yaml';
	const GLOBAL_ROUTES_FILE = '../conf/routes.yaml';

	const MAX_ITEM_COUNT = 10000;

	/**
	 *
	 * @var ConfigurationService This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var array
	 */
	private $configurationGlobal = [];

	/**
	 *
	 * @var array
	 */
	private $routesGlobal = [];

  /**
   * @return ConfigurationService
   */
  public static function getInstance(): ConfigurationService {

		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * ConfigurationService constructor.
   */
	private function __construct() {

		$this->loadConfigurations ();
	}

  /**
	 *
   */
	private function loadConfigurations () {

		$configurations = [
			['file' => self::GLOBAL_CONF_FILE, 'label' => 'global configuration', 'var' => &$this->configurationGlobal],
			['file' => self::GLOBAL_ROUTES_FILE, 'label' => 'global routes', 'var' => &$this->routesGlobal]
		];

		try {
			foreach ($configurations as $configuration) {
				try {
					if (! ($configuration['var'] = Yaml::parseFile ($configuration['file']))) {
						throw new ExceptionFatal (ExceptionFatal::E_FATAL,
							'Cannot parse ' . $configuration['label']);
					}
				} catch (ParseException $e) {
					throw new ExceptionFatal (ExceptionFatal::E_FATAL,
						'Cannot parse ' . $configuration['label'] . ', error: ' . $e->getMessage ());
				}
			}
		} catch (ExceptionFatal $e) {}
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
	 * @return string
	 */
	public function getSiteName (): string {

		return $this->getConfigurationGlobalItem ('Site', 'name');
	}

	/**
	 * @param int $errorCode
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
	 * @return array
	 */
	public function getRoutesGlobal (): array {

		$return = [];

		if ($this->routesGlobal) {
			foreach ($this->routesGlobal as $key => $route) {
				$return[] = (object)array_merge(['name' => $key], $route);
			}
		}

		return $return;
	}

	/**
	 *
	 * @param string $section
	 * @return array
	 */
	public function getConfigurationGlobal (string $section = ''): array {

		if ($section && isset ($this->configurationGlobal[$section])) {
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
	 * @return string|array
	 */
	public function getConfigurationGlobalItem () {

		list ($section, $ids) = self::prepare (func_get_args ());
		return $this->getYamlItem ($this->configurationGlobal, $section, $ids);
	}

	/**
	 * @param array $configuration
	 * @param string $section
	 * @param array $ids
	 * @return array|string
	 */
	private function getYamlItem (array $configuration, string $section, $ids) {

		$configurationItem = '';

		try {
			if (isset ($configuration[$section])) {
				if ($ids) {
					if (self::MAX_ITEM_COUNT < ($maxId = count ($ids))) {
						throw new ExceptionRuntime (
							ExceptionRuntime::E_WARNING, t ('Too many global configuration items'));
					}
					$level = 0;
					$base = $configuration[$section];
					foreach ($ids as $id) {
						if (isset ($base[$id])) {
							$base = $base[$id];
							$level++;
						} else {
							break;
						}
					}
					if (count($ids) === $level) {
						$configurationItem = $base;
					}
				}
			}
		} catch (ExceptionRuntime $e) {}

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
