<?php

namespace Ocms\core\model;

use Ocms\core\exception\ExceptionBase;
use Ocms\core\exception\ExceptionFatal;
use Ocms\core\exception\ExceptionRuntime;
use Ocms\core\Kernel;

/**
 * Model Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.5 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class Model implements ModelInterface {

	const DB_TYPE_MYSQL = 'mysql';
	const DB_TYPE_SQLITE = 'sqlite';

	/**
	 *
	 * @var Model This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var \PDO
	 */
	private $db;

	/**
	 * @var string
	 */
	private $dbType;

	/**
	 *
	 * @var string
	 */
	private $dbPrefix;

	/**
	 *
	 * @var string
	 */
	private $error;

  /**
   * @return Model
   * @throws ExceptionFatal
   */
	public static function getInstance(): Model {

		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

  /**
   * Model constructor.
   * @throws ExceptionFatal
   */
	private function __construct() {

		$this->dbPrefix = Kernel::$configurationObj->getDbPrefix();
		$this->initDb();
	}

  /**
   * @throws ExceptionFatal
   */
	private function initDb() {

		switch (($this->dbType = Kernel::$configurationObj->getDbType())) {
			case self::DB_TYPE_SQLITE:
				$this->db = ModelSQLite::getInstance()->init();
				break;
			case self::DB_TYPE_MYSQL:
				$this->db = ModelMySQL::getInstance()->init();
				break;
			default:
				throw new ExceptionFatal (ExceptionFatal::E_FATAL, 'Bad DB type: ' . $this->dbType);
		}
	}

	/**
	 *
	 * @return \PDO
	 */
	public function getDb(): \PDO {

		return $this->db;
	}

	/**
	 *
	 * @return string
	 */
	public function getDbPrefix(): string {

		return $this->dbPrefix;
	}

  /**
   * @param array $args
   * @return array|null
   */
	private function normalizeArgs(array $args) {

		if (count($args) === 0) {
			$return = null;
		} else if (count($args) === 1 && is_object($args[0])) {
			$return = array_values((array) $args[0]);
		} else if (count($args) === 1 && is_array($args[0])) {
			$return = array_values($args[0]);
		} else {
			$return = $args;
		}
		return $return;
	}

  /**
   * @param array $args
   * @return array
   */
	private function prepare (array $args): array {

		$sql = array_shift($args);
		$args = $this->normalizeArgs($args);
		$sql = str_replace('/*prefix*/', $this->dbPrefix, $sql);
		$stmt = $this->db->prepare($sql);
		return [$stmt, $args];
	}

	/**
	 * @return bool
	 * @throws ExceptionRuntime
	 */
	public function execute (): bool {

		try {
			list ($stmt, $args) = self::prepare (func_get_args (), 1);
			return $stmt->execute ($args);
		} catch (\PDOException $e) {
			$this->error = $e->getMessage ();
			throw new ExceptionRuntime (ExceptionBase::E_FATAL, $this->error);
		}
	}

	/**
	 * @return object
	 * @throws ExceptionRuntime
	 */
	public function single() {

		try {
			list($stmt, $args) = $this->prepare(func_get_args());
			$stmt->execute($args);
			return $stmt->fetchObject();
		} catch (\PDOException $e) {
			$this->error = $e->getMessage();
			throw new ExceptionRuntime (ExceptionBase::E_FATAL, $this->error);
		}
	}

	/**
	 * @return array
	 * @throws ExceptionRuntime
	 */
	public function fetch() {

		try {
			list ($stmt, $args) = self::prepare(func_get_args());
			$stmt->execute($args);
			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\PDOException $e) {
			$this->error = $e->getMessage();
			throw new ExceptionRuntime (ExceptionBase::E_FATAL, $this->error);
		}
	}

	/**
	 * @return string
	 * @throws ExceptionRuntime
	 */
	public function shift(): string {

		try {
			list ($stmt, $args) = self::prepare(func_get_args());
			$stmt->execute($args);
			$res = $stmt->fetch(\PDO::FETCH_NUM);
			return (string)$res[0];
		} catch (\PDOException $e) {
			$this->error = $e->getMessage();
			throw new ExceptionRuntime(ExceptionBase::E_FATAL, $this->error);
		}
	}

	/**
	 * @param string|null $name
	 * @return int
	 */
	public function getLastId (string $name=null): int {

		return $this->db->lastInsertId ($name);
	}

	/**
	 * @param string $field
	 * @param string $needle
	 * @return string
	 */
	public function getSQLFindInSet (string $field, string $needle): string {

		switch ($this->dbType) {
			case self::DB_TYPE_MYSQL:
				$return = ModelMySQL::getSQLFindInSet ($field, $needle);
				break;
			case self::DB_TYPE_SQLITE:
				$return = ModelSQLite::getSQLFindInSet ($field, $needle);
				break;
			default:
				$return = '';
		}

		return $return;
	}
}
