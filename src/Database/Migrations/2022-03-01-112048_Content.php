<?php

namespace Colabs\Cms\Database\Migrations;

use CodeIgniter\Database\Migration;

class Content extends Migration
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
			'title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'url_slug'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
			'description'      => [
				'type'           => 'TEXT',
                'null'        => true,
			],
            'thumbnail'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'meta_title'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'meta_keyword'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'meta_description'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255'
			],
            'category_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
            'menu_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
			],
			'status'      => [
				'type'           => 'INT',
                'constraint'     => 1,
				'default'        => '0',
			],
            'created_at'          => [
				'type'           => 'DATETIME',
                'null'           => true,
			],
            'updated_at'          => [
				'type'           => 'DATETIME',
                'null'           => true,
			],
		]);

		// Membuat primary key
		$this->forge->addKey('id', TRUE);

		// Membuat tabel news
		$this->forge->createTable('cms_content', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('cms_content');
    }
}