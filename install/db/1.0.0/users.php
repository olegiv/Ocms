<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class UsersMigration_100
 */
class UsersMigration_100 extends Migration
{
	const TABLE_USERS = 'users';

	/**
	 * Define the table structure
	 *
	 * @return void
	 * @throws \Phalcon\Db\Exception
	 */
    public function morph(): void
    {
        $this->morphTable(self::TABLE_USERS, [
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
		                'active',
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
                        'username',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 32
                        ]
                    ),
                    new Column(
                        'password',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 40
                        ]
                    ),
	                new Column(
		                'role',
		                [
			                'type' => Column::TYPE_VARCHAR,
			                'notNull' => true,
			                'size' => 32
		                ]
	                ),
	                new Column(
		                'email',
		                [
			                'type' => Column::TYPE_VARCHAR,
			                'notNull' => true,
			                'size' => 255
		                ]
	                ),
                    new Column(
                        'first_name',
                        [
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 255
                        ]
                    ),
	                new Column(
		                'last_name',
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
        $this->batchInsert(self::TABLE_USERS, [
                'id',
		        'active',
		        'created_at',
                'username',
                'password',
				'role',
				'email',
                'first_name',
                'last_name'
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
        $this->batchDelete(self::TABLE_USERS);
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
