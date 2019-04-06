<?php

namespace Ocms\core;

use Ocms\core\service\Alias\AliasService;
use Ocms\core\service\Configuration\ConfigurationService;
use Ocms\core\service\Log\LogService;
use Ocms\core\block\Block;
use Ocms\core\model\Model;
use Ocms\core\view\View;
use Ocms\core\service\Router\Router;
use Ocms\core\service\I18n\I18n;
use Ocms\core\service\Menu\MenuService;
use Ocms\core\service\User\UserService;

use Ocms\core\controller\NodeController;
use Ocms\core\controller\FrontController;
use Ocms\core\controller\BlogController;
use Ocms\core\controller\BlockController;

require_once 'Helper.php';

/**
 * Kernel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.7 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class Kernel implements KernelInterface {

	const VERSION = '0.0.4';

	const NODE_BLOG = 'NODE_BLOG';
	const NODE_PAGE = 'NODE_PAGE';

	/**
	 *
	 * @var Kernel This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var Router
	 */
	public static $routerObj;

	/**
	 *
	 * @var ConfigurationService
	 */
	public static $configurationObj;

	/**
	 *
	 * @var LogService
	 */
	public static $logObj;

	/**
	 *
	 * @var Model
	 */
	public static $modelObj;

	/**
	 *
	 * @var View
	 */
	public static $viewObj;

	/**
	 *
	 * @var I18n
	 */
	public static $i18nObj;

	/**
	 *
	 * @var MenuService
	 */
	public static $menuObj;

	/**
	 *
	 * @var UserService
	 */
	public static $userObj;

	/**
	 *
	 * @var Block
	 */
	public static $blockObj;

	/**
	 *
	 * @var AliasService
	 */
	public static $aliasObj;

	/**
	 *
	 * @var NodeController
	 */
	public static $nodeControllerObj;

	/**
	 *
	 * @var FrontController
	 */
	public static $frontControllerObj;

	/**
	 *
	 * @var BlogController
	 */
	public static $blogControllerObj;

	/**
	 *
	 * @var BlockController
	 */
	public static $blockControllerObj;

	/**
	 * @var string
	 */
	public static $siteRoot;

	/**
	 * @var string
	 */
	public static $libRoot;

	/**
	 * @param string $siteRoot
	 * @return Kernel
	 */
  public static function getInstance(string $siteRoot): Kernel {

		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self($siteRoot);
		}
    return self::$_instance;
  }

	/**
	 * Kernel constructor.
	 * @param string $siteRoot
	 */
	private function __construct(string $siteRoot) {

		self::$siteRoot = $siteRoot;
		self::$libRoot = $siteRoot . '/../';

		self::$configurationObj = ConfigurationService::getInstance();
		self::$logObj = LogService::getInstance();
		$this->setEnv();
		self::$viewObj = View::getInstance();
		self::$modelObj = Model::getInstance();
		self::$i18nObj = I18n::getInstance();
		self::$menuObj = MenuService::getInstance();
		self::$userObj = UserService::getInstance();
		self::$routerObj = Router::getInstance();
		self::$blockObj = Block::getInstance();
		self::$aliasObj = AliasService::getInstance();
		self::$nodeControllerObj = NodeController::getInstance();
		self::$frontControllerObj = FrontController::getInstance();
		self::$blogControllerObj = BlogController::getInstance();
		self::$blockControllerObj = BlockController::getInstance();
	}

	/**
	 *
	 */
	public function run () {

		self::$routerObj->run();
	}

	/**
	 *
	 */
	private function setEnv () {

		if (($errorReporting = self::$configurationObj->getConfigurationGlobalItem ('Server', 'errorReporting'))) {
			eval ('?><?php error_reporting (' . $errorReporting . '); ?>');
		}
		if (self::$configurationObj->getConfigurationGlobalItem ('Server', 'displayErrors')) {
			ini_set ('display_errors', 1);
		}
	}

	/**
	 *
	 * @return bool
	 */
	public static function inDebug (): bool {

		return (bool)self::$configurationObj->getConfigurationGlobalItem ('Server', 'debug');
	}

	/**
	 * @return array
	 */
	public static function getSiteConfiguration(): array {

		return self::$configurationObj->getConfigurationGlobal('Site');
	}
}
