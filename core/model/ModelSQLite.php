<?php

namespace Ocms\core\model;

/**
 * Description of ModelSQLite
 *
 * @author olegiv
 */
class ModelSQLite implements ModelSQLiteInterface {

	const DBFile = 'data/scms.db';
	const INSTALLFile = 'Ocms/install/sqlite.sql';

	/**
	 *
	 * @var ModelSQLite This class instance
	 */
	static $_instance;

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
	private function __construct() {}

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
	 * @throws \Exception
	 */
	private function getInitSql (): string {
		
		if (!($sqls = file (self::INSTALLFile))) {
			throw new \Exception ('Cannot open file: ' . self::INSTALLFile);
		}
		return implode("\n", $sqls);
	}

}
