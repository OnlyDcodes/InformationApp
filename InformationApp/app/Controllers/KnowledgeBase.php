<?php

namespace App\Controllers;

use App\Models\KnowledgeBaseModel;
use CodeIgniter\RESTful\ResourceController;

class KnowledgeBase extends ResourceController
{
    protected $modelName = 'App\Models\KnowledgeBaseModel';
    // Restore format if it was removed, or remove if not needed previously
    // protected $format    = 'json'; 

    public function index()
    {
        // Revert: Remove user check/filtering
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
        // Revert: Remove user check/filtering
        $model = new KnowledgeBaseModel();
        $data = $model->find($id); // Find by ID directly
        
        if (!$data) {
            // Keep original error handling
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
            // Or use throw PageNotFoundException if that was the previous method
        }
        
        return view('knowledge_base/show', ['entry' => $data]);
    }

    public function new()
    {
        // Revert: Remove user check
        return view('knowledge_base/create');
    }

    public function create()
    {
        // Revert: Remove user check and user_id assignment
        $model = new KnowledgeBaseModel();
        
        $rules = [
            'title' => 'required|min_length[3]',
            'project_code' => 'required',
            'solution' => 'required',
            // Add back other rules if they existed before
            'status' => 'required', 
            'rating' => 'permit_empty|integer|less_than_equal_to[5]',
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
        // Prepare data without user_id, use original created_by/modified_by if applicable
        $creatorUsername = auth()->loggedIn() ? auth()->user()->username : 'System'; // Handle case if user might not be logged in
        
        $data = [
            'title'        => $this->request->getVar('title'),
            'project_code' => $this->request->getVar('project_code'),
            'solution'     => $this->request->getVar('solution'),
            'status'       => $this->request->getVar('status'),
            'rating'       => $this->request->getVar('rating'),
            // Remove 'user_id' => auth()->id(),
            'created_by'   => $creatorUsername, 
            'modified_by'  => $creatorUsername, 
        ];
        
        if ($model->save($data)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry created successfully');
        } else {
            // Keep original error handling
            log_message('error', 'KnowledgeBase Create Failed: ' . print_r($model->errors(), true));
            return redirect()->back()->withInput()->with('error', 'Failed to create entry.')->with('errors', $model->errors());
        }
    }

    public function edit($id = null)
    {
        // Revert: Remove user check/filtering
        $model = new KnowledgeBaseModel();
        $data = $model->find($id); // Find directly
        
        if (!$data) {
            // Keep original error handling
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        return view('knowledge_base/edit', ['entry' => $data]);
    }

    public function update($id = null)
    {
        // Revert: Remove user check/filtering
        $model = new KnowledgeBaseModel();
        
        // Find directly
        if (!$model->find($id)) { 
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        $rules = [
            'title' => 'required|min_length[3]',
            'project_code' => 'required',
            'solution' => 'required',
            // Add back other rules if they existed before
            'status' => 'required', 
            'rating' => 'permit_empty|integer|less_than_equal_to[5]',
        ];
        
        if (!$this->validate($rules)) {
            // Redirect back to edit page
            return redirect()->to('/knowledge-base/'.$id.'/edit')->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare data without user_id check, use original modified_by if applicable
        $modifierUsername = auth()->loggedIn() ? auth()->user()->username : 'System'; // Handle case if user might not be logged in
        
        $data = [
            // 'id' is handled by save/update
            'title'        => $this->request->getVar('title'),
            'project_code' => $this->request->getVar('project_code'),
            'solution'     => $this->request->getVar('solution'),
            'status'       => $this->request->getVar('status'),
            'rating'       => $this->request->getVar('rating'),
            'modified_by'  => $modifierUsername, // Update modifier
        ];
        
        // Use update method
        if ($model->update($id, $data)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry updated successfully');
        } else {
            // Keep original error handling
            log_message('error', 'KnowledgeBase Update Failed (ID: '.$id.'): ' . print_r($model->errors(), true));
            return redirect()->to('/knowledge-base/'.$id.'/edit')->withInput()->with('error', 'Failed to update entry.')->with('errors', $model->errors());
        }
    }

    public function delete($id = null)
    {
        // Revert: Remove user check/filtering
        $model = new KnowledgeBaseModel();
        
        // Find directly
        if (!$model->find($id)) {
            return redirect()->to('/knowledge-base')->with('error', 'Knowledge base entry not found');
        }
        
        // Use delete method
        if ($model->delete($id)) {
            return redirect()->to('/knowledge-base')->with('message', 'Knowledge base entry deleted successfully');
        } else {
            // Keep original error handling
            log_message('error', 'KnowledgeBase Delete Failed (ID: '.$id.'): ' . print_r($model->errors(), true));
            return redirect()->to('/knowledge-base')->with('error', 'Failed to delete knowledge base entry');
        }
    }
}