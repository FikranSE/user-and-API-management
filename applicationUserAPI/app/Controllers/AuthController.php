<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view('auth/login');
    }
    public function loginProses()
      {
          $data = [];

          if ($this->request->getMethod() === 'post') {
              $rules = [
                  'username' => 'required',
                  'password' => 'required',
              ];

              if ($this->validate($rules)) {
                  $username = $this->request->getPost('username');
                  $password = $this->request->getPost('password');

                  $user = $this->userModel->where('username', $username)->first();

                  if ($user) {
                    if (password_verify($password, $user['password'])) {
                        session()->set('id', $user['id']);
                        session()->set('username', $user['username']);
                        session()->set('role', $user['role']);
                        return redirect()->to('/');
                    } else {
                        $data['error'] = 'Invalid password';
                    }
                } else {
                    $data['error'] = 'Username not found';
                }
              } else {
                  $data['validation'] = $this->validator;
              }
          }

          return view('auth/login', $data);
      }

      public function logout()
      {
          session()->destroy();
          return redirect()->to('auth/login');
      }


}