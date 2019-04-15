<?php

namespace Ocms\core\service\Configuration;

/**
 * ConfigurationServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.4 15.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface ConfigurationServiceInterface {

	/**
	 *
	 * @return ConfigurationService
	 */
  public static function getInstance(): ConfigurationService;

	/**
	 *
	 * @param string $section
	 * @return array
	 */
	public function getConfigurationGlobal (string $section = ''): array;

	/**
	 *
	 * @return array
	 */
	public function getRoutesGlobal (): array;

	/**
	 * @return mixed
	 */
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

	/**
	 *
	 * @return string|array
	 */
	public function getConfigurationGlobalItem ();

  /**
   * @param int $errorCode
   * @return int
   */
	public function getErrorPageId (int $errorCode): int;
}
