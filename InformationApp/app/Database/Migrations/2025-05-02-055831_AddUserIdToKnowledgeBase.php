<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToKnowledgeBase extends Migration
{
    public function up()
    {
            $fields = [
                'user_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => false, // Or true if entries can exist without a user initially
                    'after'      => 'rating', // Place it after the rating column (optional)
                ],
            ];
            $this->forge->addColumn('knowledge_base', $fields);

            // Optional: Add a foreign key constraint if you have a 'users' table
            // Make sure the 'users' table and its primary key ('id') exist
            // $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        //
    }
}
