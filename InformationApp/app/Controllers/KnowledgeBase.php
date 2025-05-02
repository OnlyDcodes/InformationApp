<?php

namespace App\Controllers;

use App\Models\KnowledgeBaseModel;
use CodeIgniter\RESTful\ResourceController;

class KnowledgeBase extends ResourceController
{
    protected $modelName = 'App\Models\KnowledgeBaseModel';
    protected $format    = 'json';

    public function index()
    {
        $model = new KnowledgeBaseModel();
        $data = $model->findAll();
        
        return view('knowledge_base/index', ['knowledge_base' => $data]);
    }

    public function show($id = null)
    {
        $model = new KnowledgeBaseModel();
        $data = $model->find($id);
        
        if (!$data) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        return view('knowledge_base/show', ['entry' => $data]);
    }

    public function new()
    {
        return view('knowledge_base/create');
    }

    public function create()
    {
        $model = new KnowledgeBaseModel();
        
        $data = [
            'title'        => $this->request->getPost('title'),
            'project_code' => $this->request->getPost('project_code'),
            'solution'     => $this->request->getPost('solution'),
            'status'       => $this->request->getPost('status'),
            'rating'       => $this->request->getPost('rating'),
            'created_by'   => 'System', // You might want to replace this with actual user info
            'modified_by'  => 'System', // You might want to replace this with actual user info
        ];
        
        if ($model->save($data)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry created successfully');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function edit($id = null)
    {
        $model = new KnowledgeBaseModel();
        $data = $model->find($id);
        
        if (!$data) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        return view('knowledge_base/edit', ['entry' => $data]);
    }

    public function update($id = null)
    {
        $model = new KnowledgeBaseModel();
        
        if (!$model->find($id)) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        $data = [
            'id'           => $id,
            'title'        => $this->request->getPost('title'),
            'project_code' => $this->request->getPost('project_code'),
            'solution'     => $this->request->getPost('solution'),
            'status'       => $this->request->getPost('status'),
            'rating'       => $this->request->getPost('rating'),
            'modified_by'  => 'System', // You might want to replace this with actual user info
        ];
        
        if ($model->save($data)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry updated successfully');
        } else {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }
    }

    public function delete($id = null)
    {
        $model = new KnowledgeBaseModel();
        
        if (!$model->find($id)) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        if ($model->delete($id)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry deleted successfully');
        } else {
            return redirect()->to('/knowledge-base')->with('error', 'Failed to delete knowledge base entry');
        }
    }
}