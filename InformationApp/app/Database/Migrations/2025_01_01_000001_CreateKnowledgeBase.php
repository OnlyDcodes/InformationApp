<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKnowledgeBase extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'project_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'solution' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'rating' => [
                'type'       => 'INT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'created_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'modified_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'modified_by' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('knowledge_base');
    }

    public function down()
    {
        $this->forge->dropTable('knowledge_base');
    }
} 