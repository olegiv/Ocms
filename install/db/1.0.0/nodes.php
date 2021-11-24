<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class NodesMigration_100
 */
class NodesMigration_100 extends Migration
{
	const TABLE_NODES = 'nodes';

	/**
	 * Define the table structure
	 *
	 * @return void
	 * @throws \Phalcon\Db\Exception
	 */
	public function morph(): void
	{
		$this->morphTable(self::TABLE_NODES, [
				'columns' => [
					new Column(
						'id',
						[
							'type' => Column::TYPE_INTEGER,
							'unsigned' => true,
							'notNull' => true,
							'autoIncrement' => true,
							'size' => 10,
							'first' => true
						]
					),
					new Column(
						'id2_owner',
						[
							'type' => Column::TYPE_INTEGER,
							'unsigned' => true,
							'notNull' => true,
							'size' => 10
						]
					),
					new Column(
						'is_published',
						[
							'type' => Column::TYPE_BOOLEAN,
							'notNull' => true,
							'size' => 1
						]
					),
					new Column(
						'created_at',
						[
							'type' => Column::TYPE_TIMESTAMP,
							'default' => 'CURRENT_TIMESTAMP',
							'notNull' => true
						]
					),
					new Column(
						'title',
						[
							'type' => Column::TYPE_VARCHAR,
							'notNull' => true,
							'size' => 255
						]
					),
					new Column(
						'abstract',
						[
							'type' => Column::TYPE_TEXT,
							'notNull' => true
						]
					),
					new Column(
						'body',
						[
							'type' => Column::TYPE_TEXT,
							'notNull' => true
						]
					),
					new Column(
						'alias',
						[
							'type' => Column::TYPE_VARCHAR,
							'notNull' => true,
							'size' => 255
						]
					)
				],
				'indexes' => [
					new Index('PRIMARY', ['id'], 'PRIMARY')
				],
				'options' => [
					'TABLE_TYPE' => 'BASE TABLE',
					'ENGINE' => 'InnoDB'
				]
			]
		);
	}

	/**
	 * Run the migrations
	 *
	 * @return void
	 */
	public function up(): void
	{
		$this->batchDelete(self::TABLE_NODES);
		$this->batchInsert(self::TABLE_NODES, [
				'id',
				'id2_owner',
				'is_published',
				'created_at',
				'title',
				'abstract',
				'body',
				'alias'
			]
		);
	}

	/**
	 * Reverse the migrations
	 *
	 * @return void
	 */
	public function down(): void
	{
		$this->batchDelete(self::TABLE_NODES);
	}

	/**
	 * This method is called after the table was created
	 *
	 * @return void
	 */
	public function afterCreateTable(): void
	{
	}
}
