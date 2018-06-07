<?php

namespace Ocms\core\model;

use Ocms\core\service\Configuration\ConfigurationService;

/**
 * Description of Model
 *
 * @author olegiv
 */
class Model implements ModelInterface {
	
	/**
	 *
	 * @var Model This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var type \PDO
	 */
	private $db;

	/**
	 * 
	 * @return Model
	 */
  public static function getInstance(): Model {
  
		if(!(self::$_instance instanceof self)) {
      self::$_instance = new self();
		}
    return self::$_instance;
  }
	
	/**
	 * 
	 */
	private function __construct() {}

	/**
	 * 
	 * @throws \Exception
	 */
	public function init() {
		
		switch (($dbType = ConfigurationService::getInstance()->getDbType())) {
			case 'sqlite':
				$this->db = ModelSQLite::getInstance()->init();
				break;
			case 'mysql':
				break;
			default:
				throw new \Exception ('Bad DB type: ' . $dbType);
		}
	}

}
