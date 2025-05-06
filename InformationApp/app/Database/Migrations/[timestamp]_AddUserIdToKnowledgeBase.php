<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToKnowledgeBase extends Migration
{
    public function up()
    {
        $this->forge->addColumn('knowledge_base', [
            'user_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
        ]);
        
        // Add foreign key
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'SET NULL');
    }

    public function down()
    {
        $this->forge->dropForeignKey('knowledge_base', 'knowledge_base_user_id_foreign');
        $this->forge->dropColumn('knowledge_base', 'user_id');
    }
} 