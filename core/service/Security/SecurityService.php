<?php

namespace Ocms\core\service\Security;

use Ocms\core\exception\ExceptionFatal;
use Ocms\core\Kernel;

/**
 * SecurityService Class.
 *
 * @package core
 * @access public
 * @since 05.04.2019
 * @version 0.0.0 05.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class SecurityService implements SecurityServiceInterface {

	public static function validateStartup () {

		try {
			self::validateDomain();
		} catch (ExceptionFatal $e) {}
	}

	/**
	 * @throws ExceptionFatal
	 */
	private static function validateDomain () {

		if (! ($trustedDomains = Kernel::$configurationObj->getConfigurationGlobalItem ('Site', 'trustedDomains'))) {
			throw new ExceptionFatal (ExceptionFatal::E_FATAL, t ('Site - trustedDomains global parameter missing'));
		}
		$currentDomain = $_SERVER['HTTP_HOST'];
		if (! in_array ($currentDomain, $trustedDomains)) {
			throw new ExceptionFatal (ExceptionFatal::E_FATAL,
				t ('Current domain %s is not in Site - trustedDomains', $currentDomain));
		}
	}
}
