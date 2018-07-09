<?php


use Phinx\Migration\AbstractMigration;

class CreateUserTable extends AbstractMigration
{
	public function up()
	{
		$this
			->table('users')
			->addColumn('email', 'string', ['limit' => 255])
			->addColumn('password', 'string', ['limit' => 255])
			->addTimestamps()->save();
	}

	public function down()
	{
		$this->table('users')->drop();
	}
}
