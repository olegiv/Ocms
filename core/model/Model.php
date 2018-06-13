<?php

namespace Ocms\core\model;

use Ocms\core\exception\ExceptionRuntime;
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
	 * @var string
	 */
	private $dbPrefix;

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
	private function __construct() {
		
		$this->dbPrefix = ConfigurationService::getInstance()->getDbPrefix();
		$this->initDb();
	}

	/**
	 * 
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	private function initDb() {
		
		switch (($dbType = ConfigurationService::getInstance()->getDbType())) {
			case 'sqlite':
				$this->db = ModelSQLite::getInstance()->init();
				break;
			case 'mysql':
				break;
			default:
				throw new ExceptionRuntime (ExceptionRuntime::E_FATAL, t ('Bad DB type: %s', $dbType));
		}
	}
	
	/**
	 * 
	 * @param int $nodeId
	 * @return \stdClass
	 */
	public function getNode (int $nodeId) {
		
		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'node WHERE id=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$nodeId]);
		return $stmt->fetchObject ();
	}

	/**
	 *
	 * @param int $blogId
	 * @return \stdClass
	 */
	public function getBlog (int $blogId) {

		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'blog WHERE id=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$blogId]);
		return $stmt->fetchObject();
	}

	/**
	 *
	 * @return array
	 */
	public function getBlogs () {

		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'blog';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}

	/**
	 * 
	 * @param int $blockId
	 * @return \stdClass
	 */
	public function getBlock (int $blockId) {
		
		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'block WHERE id=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$blockId]);
		return $stmt->fetchObject();
	}
	
	/**
	 * 
	 * @return array
	 */
	public function getBlocks () {
		
		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'block';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_OBJ);
	}

	/**
	 *
	 * @return array
	 */
	public function getBlocksForBlogIndex () {

		/**
		 * @todo
		 */
		return $this->getBlocks ();
	}
}
