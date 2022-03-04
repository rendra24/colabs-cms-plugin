<?php

namespace Colabs\Cms\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true
			],
			'field'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'name'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'value'       => [
				'type'           => 'TEXT',
				'default' 	     => '',
''			],
			'status'      => [
				'type'           => 'INT',
                'constraint'     => 1,
				'default'        => '0',
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('cms_setting', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('cms_setting');
	}
}