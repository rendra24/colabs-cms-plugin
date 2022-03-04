<?php

namespace Colabs\Cms\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubMenu extends Migration
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
            'urutan'          => [
				'type'           => 'INT',
				'constraint'     => 11
			],
			'nama_sub'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'content_type'       => [
				'type'           => 'INT',
				'constraint'     => '1',
				'default'        => '1',

			],
			'link'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'        => true,
			],
			'slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'menu_id'          => [
				'type'           => 'INT',
				'constraint'     => '11'
			],
			'status'      => [
				'type'           => 'INT',
                'constraint'     => 1,
				'default'        => '0',
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('cms_menu_sub', TRUE);
	}

	public function down()
	{
		$this->forge->dropTable('cms_menu_sub');
	}
}