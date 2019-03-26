<?php

namespace Ocms\core\model;

use Ocms\core\exception\ExceptionBase;
use Ocms\core\exception\ExceptionFatal;
use Ocms\core\Kernel;

/**
 * ModelSQLite Class.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.4 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
class ModelSQLite extends ModelAbstract implements ModelSQLiteInterface {

	/**
	 * @var string
	 */
	protected $dbFile;

	/**
	 *
	 * @var ModelSQLite This class instance
	 */
	static $_instance;

	/**
	 * ModelSQLite constructor.
	 */
	protected function __construct() {

		parent::__construct ();
		$this->dbFile = Kernel::$libRoot . 'data/ocms.db';
		$this->initialSqlFile = Kernel::$libRoot . 'install/sqlite.sql';
	}

	/**
	 *
	 * @return ModelSQLite
	 */
	public static function getInstance (): ModelSQLite {

		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 *
	 * @return bool
	 */
	protected function isDbInited (): bool {

		return (file_exists($this->dbFile) && filesize($this->dbFile) > 0);
	}

	/**
	 *
	 */
	protected function connect () {

		$this->db = new \PDO('sqlite:' . $this->dbFile);
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

  /**
   * @throws ExceptionFatal
   */
	protected function createDb () {

		if (! ($handle = @fopen ($this->dbFile, 'w'))) {
			throw new ExceptionFatal (ExceptionBase::E_FATAL, 'Cannot create SQLite file: ' . $this->dbFile);
		}
		fclose($handle);
	}

	/**
	 * @throws ExceptionFatal
	 */
	protected function initDb () {

		try {
			$this->createDb ();
			$this->connect ();
			$this->db->exec ($this->getInitSql ($this->initialSqlFile));
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

		return str_replace (
			['%field%', '%needle%'],
			[$field, $needle],
			'`%field%` LIKE \'%needle%,%\' OR
			`%field%` LIKE \'%,%needle%\' OR
			`%field%` LIKE \'%,%needle%,%\'
			OR `%field%` = \'%needle%\''
		);
	}
}
