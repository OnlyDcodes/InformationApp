<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Shield\Models\UserModel;
use Exception;

class Auth extends BaseController
{
    protected $auth;

    public function __construct()
    {
        $this->auth = service('auth');
    }

    public function login()
    {
        if ($this->auth->loggedIn()) {
            return redirect()->to('/');
        }
        
        return view('auth/login');
    }
    
    public function attemptLogin()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required|min_length[8]',
        ];
        
        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        try {
            $credentials = [
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ];
            
            $loginAttempt = $this->auth->attempt($credentials);
            
            if (!$loginAttempt) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid login credentials');
            }
            
            return redirect()->to('/')->with('message', 'Login successful');
        } catch (Exception $e) {
            log_message('error', 'Login error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid login credentials. Please try again.');
        }
    }
    
    public function register()
    {
        if ($this->auth->loggedIn()) {
            return redirect()->to('/');
        }
        
        return view('auth/register');
    }
    
    public function attemptRegister()
    {
        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[auth_identities.secret]',
            'password' => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];
        
        if (! $this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        
        try {
            $users = model(UserModel::class);
            
            $user = new \CodeIgniter\Shield\Entities\User([
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
            ]);
            
            $users->save($user);
            
            $user = $users->findById($users->getInsertID());
            
            $user->activate();
            
            $users->save($user);
            
            $this->auth->login($user);
            
            return redirect()->to('/')->with('message', 'Registration successful');
        } catch (Exception $e) {
            log_message('error', 'Registration error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Registration failed. Please try again.');
        }
    }
    
    public function logout()
    {
        try {
            $this->auth->logout();
            return redirect()->to('login')->with('message', 'Logout successful');
        } catch (Exception $e) {
            log_message('error', 'Logout error: ' . $e->getMessage());
            return redirect()->to('login');
        }
    }
}
