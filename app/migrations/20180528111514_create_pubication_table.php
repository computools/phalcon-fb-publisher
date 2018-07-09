<?php


use Phinx\Migration\AbstractMigration;

class CreatePubicationTable extends AbstractMigration
{
   public function up()
   {
	   $table = $this->table('publication');
	   $table->addColumn('channel_id', 'integer');
	   $table->addColumn('post_id', 'integer');
	   $table->addColumn('success', 'boolean');
	   $table->addColumn('facebook_id', 'string', ['null' => true]);
	   $table->addColumn('error_message', 'text', ['null' => true]);
	   $table->addTimestamps();

	   $table->addForeignKey('channel_id', 'channel', 'id', ['update' => 'CASCADE']);
	   $table->addForeignKey('post_id', 'post', 'id', ['update' => 'CASCADE']);

	   $table->save();
   }

   public function down()
   {
	   $this->table('publication')->drop();
   }
}
