<?php

namespace App\Models;

use CodeIgniter\Model;

class KnowledgeBaseModel extends Model
{
    protected $table            = 'knowledge_base';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'project_code', 'solution', 'status', 
        'rating', 'created_by', 'modified_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'modified_at';
    protected $deletedField  = '';

    // Validation
    protected $validationRules      = [
        'title' => 'required|min_length[3]|max_length[255]',
        'project_code' => 'required|max_length[30]',
        'solution' => 'required|max_length[255]',
        'status' => 'required|max_length[50]',
        'rating' => 'permit_empty|integer|less_than_equal_to[5]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}