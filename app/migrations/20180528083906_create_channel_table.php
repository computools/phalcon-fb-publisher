<?php


use Phinx\Migration\AbstractMigration;

class CreateChannelTable extends AbstractMigration
{
    public function up()
    {
		$this->table('channel')
			->addColumn('user_id', 'integer')
			->addColumn('facebook_id','string')
			->addColumn('access_token', 'text')
			->addTimestamps()
			->addColumn('expires_at', 'datetime', ['null' => true])
			->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
			->save();
    }

    public function down()
	{
		$this->table('channel')->drop();
	}
}
