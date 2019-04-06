<?php

namespace Ocms\core\model;

use Ocms\core\exception\ExceptionBase;
use Ocms\core\exception\ExceptionFatal;
use Ocms\core\Kernel;

/**
 * ModelAbstract Class.
 *
 * @package core
 * @access public
 * @since 30.01.2019
 * @version 0.0.2 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
abstract class ModelAbstract {

	/**
	 *
	 * @var ModelSQLite This class instance
	 */
	static $_instance;

	/**
	 *
	 * @var array
	 */
	protected $conf;

	/**
	 *
	 * @var \PDO
	 */
	protected $db;

	/**
	 * @var string
	 */
	protected $initialSqlFile = '';

	/**
	 *
	 */
	protected function __construct() {

		$this->conf = Kernel::$configurationObj->getConfigurationGlobal('DB');
	}

	/**
	 * @return \PDO
	 */
	public function init () {

		if (!$this->isDbInited ()) {
			$this->initDb ();
		} else {
			$this->connect ();
		}
		return $this->db;
	}

	/**
	 *
	 * @return bool
	 */
	protected function isDbInited (): bool {}

	/**
	 *
	 */
	protected function initDb() {}

	/**
	 *
	 * @param string $sql
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
	protected function connect () {}

	/**
	 *
	 */
	protected function createDb () {}

	/**
	 * @param string $filename
	 * @return string
	 */
	protected function getInitSql ($filename): string {

		try {
			if (!($sqls = file_get_contents($filename))) {
				throw new ExceptionFatal (ExceptionBase::E_FATAL, 'Cannot open SQL file: ' . $filename);
			}
			$return = str_replace('/*prefix*/', Kernel::$configurationObj->getDbPrefix(), $sqls);
		} catch (ExceptionFatal $e) {
			$return = '';
		}

		return $return;
	}
}
