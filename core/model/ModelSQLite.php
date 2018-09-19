<?php

namespace Ocms\core\model;

use Ocms\core\exception\ExceptionBase;
use Ocms\core\exception\ExceptionFatal;
use Ocms\core\Kernel;

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

		$this->conf = Kernel::$configurationObj->getConfigurationGlobal('DB');
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
			$this->db->exec($this->getInitSql());
		} catch (\Exception $e) {
			throw new ExceptionFatal (ExceptionBase::E_FATAL, $e->getMessage());
		}
	}

	/**
	 *
	 * @param string $sql
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	/*private function transaction (string $sql) {

		try {
			$this->db->beginTransaction();
			$this->db->exec($sql);
			$this->db->commit();
		} catch (\PDOException $e) {
			$this->db->rollBack();
			throw new ExceptionRuntime (ExceptionRuntime::E_FATAL, $e->getMessage());
		}
	}*/

	/**
	 *
	 */
	private function connect() {

		$this->db = new \PDO('sqlite:' . self::DBFile);
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	/**
	 *
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	private function createFile () {

		if (! ($handle = @fopen (self::DBFile, 'w'))) {
			throw new ExceptionFatal (ExceptionBase::E_FATAL, 'Cannot create SQLite file: ' . self::INSTALLFile);
		}
		fclose($handle);
	}

	/**
	 *
	 * @return string
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	private function getInitSql (): string {

		if (!($sql = file_get_contents (self::INSTALLFile))) {
			throw new ExceptionFatal (ExceptionBase::E_FATAL, 'Cannot open file: '  . self::INSTALLFile);
		}
		return str_replace ('#dbPrefix#', Kernel::$configurationObj->getDbPrefix(), $sql);
	}

}
