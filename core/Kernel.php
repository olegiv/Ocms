<?php

namespace Ocms\core;

use Ocms\core\service\Configuration\ConfigurationService;
use Ocms\core\service\Log\LogService;
use Ocms\core\block\Block;
use Ocms\core\model\Model;
use Ocms\core\view\View;
use Ocms\core\service\Router\Router;
use Ocms\core\service\I18n\I18n;
use Ocms\core\service\User\UserService;

use Ocms\core\controller\NodeController;
use Ocms\core\controller\FrontController;
use Ocms\core\controller\BlogController;
use Ocms\core\controller\BlockController;

use Ocms\core\service\Analytics\AnalyticsService;

require_once 'core/Helper.php';

/**
 * Description of Kernel
 *
 * @author olegiv
 */
class Kernel implements KernelInterface {

	const NODE_BLOG = 'NODE_BLOG';
	const NODE_PAGE = 'NODE_PAGE';

	/**
	 *
	 * @var Ocms\core\Kernel This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var Ocms\core\service\Router
	 */
	public static $routerObj;

	/**
	 *
	 * @var Ocms\core\service\Configuration\ConfigurationService
	 */
	public static $configurationObj;

	/**
	 *
	 * @var Ocms\core\service\Log\
	 */
	public static $logObj;

	/**
	 *
	 * @var Ocms\core\model\Model
	 */
	public static $modelObj;

	/**
	 *
	 * @var Ocms\core\view\View
	 */
	public static $viewObj;

	/**
	 *
	 * @var Ocms\core\service\I18n
	 */
	public static $i18nObj;

	/**
	 *
	 * @var Ocms\core\service\User
	 */
	public static $userObj;

	/**
	 *
	 * @var Ocms\core\block\Block
	 */
	public static $blockObj;

	/**
	 *
	 * @var Ocms\core\controller\NodeController
	 */
	public static $nodeControllerObj;

	/**
	 *
	 * @var Ocms\core\controller\FrontController
	 */
	public static $frontControllerObj;

	/**
	 *
	 * @var Ocms\core\controller\BlogController
	 */
	public static $blogControllerObj;

	/**
	 *
	 * @var Ocms\core\controller\BlockController
	 */
	public static $blockControllerObj;

	/**
	 *
	 * @var Ocms\core\service\Analytics\AnalyticsService
	 */
	public static $analyticsObj;

	/**
	 *
	 * @return Ocms\core\Kernel
	 */
  public static function getInstance(): Kernel {

		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }

	/**
	 *
	 */
	private function __construct() {

		self::$configurationObj = ConfigurationService::getInstance();
		self::$logObj = LogService::getInstance();
		$this->setEnv();
		self::$viewObj = View::getInstance();
		self::$modelObj = Model::getInstance();
		self::$i18nObj = I18n::getInstance();
		self::$userObj = UserService::getInstance();
		self::$routerObj = Router::getInstance();
		self::$blockObj = Block::getInstance();
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

		if (($errorReporting = self::$configurationObj->getConfigurationGlobal('Server')['error_reporting'])) {
			eval ('?><?php error_reporting (' . $errorReporting . '); ?>');
		}
		if (self::$configurationObj->getConfigurationGlobal('Server')['display_errors']) {
			ini_set ('display_errors', 1);
		}
	}

	/**
	 *
	 * @return bool
	 */
	public static function inDebug (): bool {

		return (bool)self::$configurationObj->getConfigurationGlobal('Server')['debug'];
	}
}
