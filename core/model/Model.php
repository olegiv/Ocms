<?php

namespace Ocms\core\model;

use Ocms\core\exception\ExceptionFatal;
use Ocms\core\Kernel;

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
	 * @var string
	 */
	private $error;

	/**
	 *
	 * @return Model
	 */
	public static function getInstance(): Model {

		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 *
	 */
	private function __construct() {

		$this->dbPrefix = Kernel::$configurationObj->getDbPrefix();
		$this->initDb();
	}

	/**
	 *
	 * @throws Ocms\core\exception\ExceptionRuntime
	 */
	private function initDb() {

		switch (($dbType = Kernel::$configurationObj->getDbType())) {
			case 'sqlite':
				$this->db = ModelSQLite::getInstance()->init();
				break;
			case 'mysql':
				break;
			default:
				throw new ExceptionFatal (ExceptionFatal::E_FATAL, 'Bad DB type: ' . $dbType);
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

	private function normalizeArgs($args) {

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

	private function prepare($args) {

		$sql = array_shift($args);
		$args = $this->normalizeArgs($args);
		$sql = str_replace('#prefix#', $this->dbPrefix, $sql);
		$stmt = $this->db->prepare($sql);
		return [$stmt, $args];
	}

	public function single() {

		try {
			list($stmt, $args) = $this->prepare(func_get_args());
			$stmt->execute($args);
			return $stmt->fetchObject();
		} catch (\PDOException $e) {
			$this->error = $e->getMessage();
			return false;
		}
	}

	public function fetch() {

		try {
			list ($stmt, $args) = self::prepare(func_get_args());
			$stmt->execute($args);
			return $stmt->fetchAll(\PDO::FETCH_OBJ);
		} catch (\PDOException $e) {
			$this->error = $e->getMessage();
			return false;
		}
	}

	public function shift() {

		try {
			list ($stmt, $args) = self::prepare(func_get_args());
			$stmt->execute($args);
			$res = $stmt->fetch(\PDO::FETCH_NUM);
			return $res[0];
		} catch (\PDOException $e) {
			self::$error = $e->getMessage();
			return false;
		}
	}

}
