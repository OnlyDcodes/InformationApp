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
        $search = $this->request->getGet('search');
        $sort = $this->request->getGet('sort') ?: 'id';
        $order = $this->request->getGet('order') ?: 'desc';
        
        // Validate sort field to prevent SQL injection
        $allowedSort = ['id', 'title', 'rating', 'status', 'project_code', 'created_by', 'modified_by'];
        if (!in_array($sort, $allowedSort)) {
            $sort = 'id';
        }
        
        // Validate order
        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'desc';
        }
        
        if ($search) {
            $model->groupStart()
                  ->like('title', $search)
                  ->orLike('project_code', $search)
                  ->orLike('solution', $search)
                  ->orLike('created_by', $search)
                  ->orLike('modified_by', $search)
                  ->groupEnd();
        }
        
        // Apply sort
        $model->orderBy($sort, $order);
        
        // Get paginated data
        $data = $model->paginate(10);
        $pager = $model->pager;
        
        return view('knowledge_base/index', [
            'knowledge_base' => $data,
            'pager' => $pager,
            'search' => $search,
            'sort' => $sort,
            'order' => $order
        ]);
    }

    public function show($id = null)
    {
        $model = new KnowledgeBaseModel();
        $data = $model->find($id);
        
        if (!$data) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        // Check if we should handle this as view/edit modal
        $modal = $this->request->getGet('modal');
        if ($modal) {
            return view('knowledge_base/index', [
                'knowledge_base' => $model->paginate(10),
                'pager' => $model->pager,
                'entry' => $data,
                'sort' => 'id',
                'order' => 'desc'
            ]);
        }
        
        return view('knowledge_base/show', ['entry' => $data]);
    }

    public function new()
    {
        return redirect()->to('/knowledge-base?open_modal=1');
    }

    public function create()
    {
        $model = new KnowledgeBaseModel();
        
        $rules = [
            'title' => 'required|min_length[3]',
            'project_code' => 'required',
            'solution' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->to('/knowledge-base')->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'title'        => $this->request->getPost('title'),
            'project_code' => $this->request->getPost('project_code'),
            'solution'     => $this->request->getPost('solution'),
            'status'       => $this->request->getPost('status'),
            'rating'       => $this->request->getPost('rating'),
            'created_by'   => auth()->user()->username,
            'modified_by'  => auth()->user()->username,
        ];
        
        if ($model->save($data)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry created successfully');
        } else {
            return redirect()->to('/knowledge-base')->with('errors', $model->errors());
        }
    }

    public function edit($id = null)
    {
        return redirect()->to("/knowledge-base/{$id}?modal=edit");
    }

    public function update($id = null)
    {
        $model = new KnowledgeBaseModel();
        
        if (!$model->find($id)) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        $rules = [
            'title' => 'required|min_length[3]',
            'project_code' => 'required',
            'solution' => 'required',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->to('/knowledge-base')->with('errors', $this->validator->getErrors());
        }
        
        $data = [
            'id'           => $id,
            'title'        => $this->request->getPost('title'),
            'project_code' => $this->request->getPost('project_code'),
            'solution'     => $this->request->getPost('solution'),
            'status'       => $this->request->getPost('status'),
            'rating'       => $this->request->getPost('rating'),
            'modified_by'  => auth()->user()->username,
        ];
        
        if ($model->save($data)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry updated successfully');
        } else {
            return redirect()->to('/knowledge-base')->with('errors', $model->errors());
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