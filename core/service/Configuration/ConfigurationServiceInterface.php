<?php

namespace Ocms\core\service\Configuration;

/**
 * ConfigurationServiceInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.1 18.12.2018
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018, OCMS
 */
interface ConfigurationServiceInterface {

	/**
	 *
	 * @return \Ocms\core\service\Configuration\ConfigurationService
	 */
  public static function getInstance(): ConfigurationService;

	/**
	 *
	 * @param string $section
	 * @return array
	 */
	public function getConfigurationGlobal (string $section = ''): array;

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
	 * @return string
	 */
	public function getConfigurationGlobalItem (): string;

  /**
   * @param int $errorCode
   * @return int
   */
	public function getErrorPageId (int $errorCode): int;
}
