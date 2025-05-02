<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Redirect to the Knowledge Base list page
        return redirect()->to('/knowledge-base');
    }
}