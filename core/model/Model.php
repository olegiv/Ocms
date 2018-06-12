<?php

namespace Ocms\core\model;

use Ocms\core\exception\Exception;
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
	 * @throws Ocms\core\exception\Exception
	 */
	private function initDb() {
		
		switch (($dbType = ConfigurationService::getInstance()->getDbType())) {
			case 'sqlite':
				$this->db = ModelSQLite::getInstance()->init();
				break;
			case 'mysql':
				break;
			default:
				throw new Exception ('Bad DB type: ' . $dbType);
		}
	}
	
	/**
	 * 
	 * @param int $nodeId
	 * @return \stdClass
	 * @throws Ocms\core\exception\Exception
	 */
	public function getNode (int $nodeId): \stdClass {
		
		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'node WHERE id=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$nodeId]);
		if (! ($node = $stmt->fetchObject ())) {
			throw new Exception (t ('Cannot load node: %s', $nodeId));
		}
		return $node;
	}
	
	/**
	 * 
	 * @param int $blockId
	 * @return \stdClass
	 * @throws Ocms\core\exception\Exception
	 */
	public function getBlock (int $blockId): \stdClass {
		
		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'block WHERE id=?';
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$blockId]);
		if (! ($block = $stmt->fetchObject())) {
			throw new Exception (t ('Cannot load block: %s', $blockId));
		}
		return $block;
	}
	
	/**
	 * 
	 * @return array
	 * @throws Ocms\core\exception\Exception
	 */
	public function getBlocks (): array {
		
		$sql = 'SELECT * FROM ' . $this->dbPrefix . 'block';
		$stmt = $this->db->prepare($sql);
		$stmt->execute();
		if (! ($blocks = $stmt->fetchAll(\PDO::FETCH_OBJ))) {
			throw new Exception (t ('Cannot load blocks'));
		}
		return $blocks;
	}
}
