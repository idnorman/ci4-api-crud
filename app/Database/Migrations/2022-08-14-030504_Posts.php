<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'title' => [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
                'null'          => false
            ],
            'content' => [
                'type'  => 'TEXT',
                'null'  => false
            ],
            'slug' => [
                'type'          => 'VARCHAR',
                'constraint'    => 128,
                'null'          => false
            ],
            'status' => [
                'type'          => 'INT',
                'constraint'    => 1,
                'null'          => false
            ],
            'created_at' => [
                'type'  => 'datetime',
                'null'  => true
            ],
            'updated_at' => [
                'type'  => 'datetime',
                'null'  => true
            ],
            'deleted_at' => [
                'type'  => 'datetime',
                'null'  => true
            ]

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
