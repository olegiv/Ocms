<?php

namespace Ocms\core\model;

use Kodus\SQLSplitter;

use Ocms\core\Kernel;
use Ocms\core\exception\ExceptionBase;
use Ocms\core\exception\ExceptionFatal;

/**
 * ModelMySQL Class.
 *
 * @package core
 * @access public
 * @since 30.01.2019
 * @version 0.0.0 30.01.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class ModelMySQL extends ModelAbstract implements ModelMySQLInterface {

	/**
	 *
	 * @var ModelMySQL This class instance
	 */
	static $_instance;

	/**
	 * @var string
	 */
	protected $initialSqlFile = 'install/mysql.sql';

	/**
	 *
	 * @return ModelMySQL
	 */
	public static function getInstance(): ModelMySQL {

		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 *
	 * @return bool
	 */
	protected function isDbInited(): bool {

		return true;
	}

	/**
	 *
	 * @param string $sql
	 * @throws ExceptionRuntime
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
	 * @throws ExceptionFatal
	 */
	protected function connect() {

		try {
			$this->db = new \PDO (
				'mysql:host=' . $this->conf['host'] . 	';dbname=' . $this->conf['dbname'],
				$this->conf['username'], $this->conf['password']);
			$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}	catch(\PDOException $e) {
			throw new ExceptionFatal (ExceptionBase::E_FATAL, 'Cannot connect to MySQL, error: ' . $e->getMessage ());
		}		
	}

  /**
   * @throws ExceptionFatal
   */
	protected function createDb () {

	}

	/**
	 * @throws ExceptionFatal
	 */
	protected function initDb () {

		try {
			$this->createDb ();
			$this->connect ();
			foreach (SQLSplitter::splitMySQL ($this->getInitSql ($this->initialSqlFile)) as $sql) {
				$this->db->exec ($sql);
			}
		} catch (\Exception $e) {
			throw new ExceptionFatal (ExceptionBase::E_FATAL, $e->getMessage());
		}
	}

	/**
	 * @param string $field
	 * @param string $needle
	 * @return string
	 */
	public static function getSQLFindInSet (string $field, string $needle): string {

		return 'FIND_IN_SET("' . $needle . '", `' . $field . '`)';
	}
}