<?php


use Phinx\Migration\AbstractMigration;

class CreatePostsTable extends AbstractMigration
{
    public function up()
    {
		$this->table('post')
			->addColumn('title', 'string', ['length' => 255])
			->addColumn('content','text', ['null' => true])
			->addColumn('user_id', 'integer')
			->addTimestamps()
			->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE'])
			->save();
    }

    public function down()
	{
		$table = $this->table('post');
		$table->dropForeignKey('user_id')->save();
		$table->drop();
	}
}
