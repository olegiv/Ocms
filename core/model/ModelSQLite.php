<?php

namespace Ocms\core\model;

use Ocms\core\exception\Exception;
use Ocms\core\service\Configuration\ConfigurationService;

/**
 * Description of ModelSQLite
 *
 * @author olegiv
 */
class ModelSQLite implements ModelSQLiteInterface {

	const DBFile = 'data/ocms.db';
	const INSTALLFile = 'install/sqlite.sql';

	/**
	 *
	 * @var ModelSQLite This class instance
	 */
	static $_instance;
	
	/**
	 *
	 * @var type 
	 */
	private $conf;

	/**
	 *
	 * @var \PDO
	 */
	private $db;

	/**
	 * 
	 * @return ModelSQLite
	 */
	public static function getInstance(): ModelSQLite {

		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * 
	 */
	private function __construct() {
		
		$this->conf = ConfigurationService::getInstance()->getConfigurationGlobal('DB');
	}

	/**
	 * 
	 * @return \PDO
	 */
	public function init() {

		if (!$this->isDbInited()) {
			$this->initDb();
		} else {
			$this->connect();
		}
		return $this->db;
	}

	/**
	 * 
	 * @return bool
	 */
	private function isDbInited(): bool {

		return (file_exists(self::DBFile) && filesize(self::DBFile) > 0);
	}

	/**
	 * 
	 */
	private function initDb() {

		try {
			$this->createFile();
			$this->connect();
			$this->transaction($this->getInitSql());
		} catch (\Exception $e) {
			echo $e->getMessage();
			die();
		}
	}
	
	private function transaction (string $sql) {
		
		try {
			$this->db->beginTransaction();
			$this->db->exec($sql);
			$this->db->commit();
		} catch (\PDOException $e) {
			echo $e->getMessage();
			$this->db->rollBack();
		}
	}

	/**
	 * 
	 */
	private function connect() {

		
		//if (($dbFile = $this->file))
		$this->db = new \PDO('sqlite:' . self::DBFile);
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	/**
	 * 
	 */
	private function createFile() {

		$handle = fopen(self::DBFile, 'w');
		fclose($handle);
	}
	
	/**
	 * 
	 * @return string
	 * @throws Ocms\core\exception\Exception
	 */
	private function getInitSql (): string {
		
		if (!($sql = file_get_contents (self::INSTALLFile))) {
			throw new Exception ('Cannot open file: ' . self::INSTALLFile);
		}
		return str_replace ('#dbPrefix#', ConfigurationService::getInstance()->getDbPrefix(), $sql);
	}

}
