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
 * @version 0.0.1 21.02.2019
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
	 * ModelMySQL constructor.
	 */
	protected function __construct() {

		parent::__construct ();
		$this->initialSqlFile = Kernel::$libRoot . 'install/mysql.sql';
	}

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
	 */
	protected function connect() {

		try {
			$this->db = new \PDO (
				'mysql:host=' . $this->conf['host'] . 	';dbname=' . $this->conf['dbname'],
				$this->conf['username'], $this->conf['password']);
			$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}	catch(\PDOException $e) {
			try {
				throw new ExceptionFatal (ExceptionBase::E_FATAL, 'Cannot connect to MySQL, error: ' . $e->getMessage());
			} catch (ExceptionFatal $e) {}
		}		
	}

	/**
	 *
	 */
	protected function createDb () {

	}

	/**
	 *
	 */
	protected function initDb () {

		try {
			$this->createDb ();
			$this->connect ();
			foreach (SQLSplitter::splitMySQL ($this->getInitSql ($this->initialSqlFile)) as $sql) {
				$this->db->exec ($sql);
			}
		} catch (\Exception $e) {
			try {
				throw new ExceptionFatal (ExceptionBase::E_FATAL, $e->getMessage());
			} catch (ExceptionFatal $e) {}
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
