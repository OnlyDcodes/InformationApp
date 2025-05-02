<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class KnowledgeBaseSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'System Down, Frontend or Backend Issue',
                'project_code' => 'Synergy PROD / UAT',
                'solution' => 'Major Task/KBS Check Solved',
                'status' => 'Solved',
                'rating' => 5,
                'created_at' => new Time('now'),
                'created_by' => 'System',
                'modified_at' => new Time('now'),
                'modified_by' => 'System',
            ],
            [
                'title' => 'Primo not accessible due to connectivity issue',
                'project_code' => 'Immediately restart',
                'solution' => 'Solved by restarting the application server',
                'status' => 'Solved',
                'rating' => 5,
                'created_at' => new Time('now'),
                'created_by' => 'System',
                'modified_at' => new Time('now'),
                'modified_by' => 'System',
            ],
            [
                'title' => 'Vtool Issue (OPS-INP115)',
                'project_code' => 'ESPAL',
                'solution' => 'Update the configuration file and restart the service',
                'status' => 'Solved',
                'rating' => 0,
                'created_at' => new Time('now'),
                'created_by' => 'System',
                'modified_at' => new Time('now'),
                'modified_by' => 'System',
            ],
            [
                'title' => 'The site cant be reached',
                'project_code' => 'For Primo or PHPMySQL',
                'solution' => 'Check network connectivity and DNS settings',
                'status' => 'Solved',
                'rating' => 0,
                'created_at' => new Time('now'),
                'created_by' => 'System',
                'modified_at' => new Time('now'),
                'modified_by' => 'System',
            ],
            [
                'title' => 'Not accessible due to "561 Authentication"',
                'project_code' => 'IETC',
                'solution' => 'Reset user credentials and clear browser cache',
                'status' => 'Solved',
                'rating' => 0,
                'created_at' => new Time('now'),
                'created_by' => 'System',
                'modified_at' => new Time('now'),
                'modified_by' => 'System',
            ],
        ];

        // Using Query Builder
        $this->db->table('knowledge_base')->insertBatch($data);
    }
}