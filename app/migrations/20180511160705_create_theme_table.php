<?php


use Phinx\Migration\AbstractMigration;

class CreateThemeTable extends AbstractMigration
{
    public function up()
    {
		$this->table('theme')
			->addColumn('title', 'string', ['length' => 255])
			->addColumn('user_id', 'integer')
			->addTimestamps()
			->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
			->save();
    }

    public function down()
	{
		$this->table('theme')->drop();
	}
}
