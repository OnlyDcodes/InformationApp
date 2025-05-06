<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $authService = service('auth');
        
        if ($authService->loggedIn()) {
            return view('home', [
                'user' => $authService->user()
            ]);
        } else {
            // Redirect to login page instead of trying to render a missing view
            return redirect()->to('login');
        }
    }
}