<?php


use Phinx\Migration\AbstractMigration;

class CreatePostThemeTable extends AbstractMigration
{
    public function up()
    {
		$this->table('post_theme', ['id' => false])
			->addColumn('post_id', 'integer')
			->addColumn('theme_id', 'integer')
			->addIndex(['post_id', 'theme_id'], [
				'unique' => true
			])
			->addForeignKey('post_id', 'post', 'id', ['delete' => 'CASCADE'])
			->addForeignKey('theme_id', 'theme', 'id', ['delete' => 'CASCADE'])
			->save();
    }

    public function down()
	{
		$this->table('post_theme')->drop();
	}
}
