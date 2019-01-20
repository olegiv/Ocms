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

use Ocms\core\service\Analytics\AnalyticsService;

require_once 'Helper.php';

/**
 * Kernel Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.2 18.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 2019, OCMS
 */
class Kernel implements KernelInterface {

	const VERSION = '0.0.1';

	const NODE_BLOG = 'NODE_BLOG';
	const NODE_PAGE = 'NODE_PAGE';

	/**
	 *
	 * @var \Ocms\core\Kernel This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var \Ocms\core\service\Router\Router
	 */
	public static $routerObj;

	/**
	 *
	 * @var \Ocms\core\service\Configuration\ConfigurationService
	 */
	public static $configurationObj;

	/**
	 *
	 * @var \Ocms\core\service\Log\
	 */
	public static $logObj;

	/**
	 *
	 * @var \Ocms\core\model\Model
	 */
	public static $modelObj;

	/**
	 *
	 * @var \Ocms\core\view\View
	 */
	public static $viewObj;

	/**
	 *
	 * @var \Ocms\core\service\I18n\I18n
	 */
	public static $i18nObj;

	/**
	 *
	 * @var \Ocms\core\service\Menu\MenuService
	 */
	public static $menuObj;

	/**
	 *
	 * @var \Ocms\core\service\User\UserService
	 */
	public static $userObj;

	/**
	 *
	 * @var \Ocms\core\block\Block
	 */
	public static $blockObj;

	/**
	 *
	 * @var \Ocms\core\service\Alias\AliasService
	 */
	public static $aliasObj;

	/**
	 *
	 * @var \Ocms\core\controller\NodeController
	 */
	public static $nodeControllerObj;

	/**
	 *
	 * @var \Ocms\core\controller\FrontController
	 */
	public static $frontControllerObj;

	/**
	 *
	 * @var \Ocms\core\controller\BlogController
	 */
	public static $blogControllerObj;

	/**
	 *
	 * @var \Ocms\core\controller\BlockController
	 */
	public static $blockControllerObj;

	/**
	 *
	 * @var \Ocms\core\service\Analytics\AnalyticsService
	 */
	public static $analyticsObj;

  /**
   * @return Kernel
   * @throws exception\ExceptionFatal
   */
  public static function getInstance(): Kernel {

		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }

  /**
   * Kernel constructor.
   * @throws exception\ExceptionFatal
   */
	private function __construct() {

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
		self::$analyticsObj = AnalyticsService::getInstance();
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
}
