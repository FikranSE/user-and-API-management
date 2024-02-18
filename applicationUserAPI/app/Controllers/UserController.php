<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;
use App\Filters\RoleMiddleware;


class UserController extends Controller
{
  use ResponseTrait;
  protected $userModel;
  protected $session;
  protected $validation;
  protected $roleMiddleware;
  protected $helpers = ['url'];

  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
      parent::initController($request, $response, $logger);

      $this->roleMiddleware = new \App\Filters\RoleMiddleware();

      $this->userModel = new UserModel();
      $this->session = \Config\Services::session();
      $this->validation = \Config\Services::validation();
  }

  // public function index()
  // {
  //     $users = [];
  //     return $this->respondSuccess($users);
  // }

  public function index()
  {
    $data['users'] = $this->userModel->findAll();
    return view('user/index', $data);
  }


  public function createUser()
  {
    if (session()->get('role') !== 'admin') {
      return redirect()->to('/');
    }
    return view('user/createUser');
  }
  public function store()
  {
    $validationRules = [
      'username' => 'required|min_length[3]|is_unique[users.username]',
      'password' => 'required|min_length[6]',
      'email'    => 'required|valid_email|is_unique[users.email]',
      'role'     => 'required|in_list[user,admin]',
    ];

    $validationMessages = [
      'username' => [
        'required'      => 'Kolom username harus diisi.',
        'min_length'    => 'Kolom username minimal harus 5 karakter.',
        'is_unique'     => 'Kolom username harus unik.',
      ],
      'password' => [
        'required'      => 'Kolom password harus diisi.',
        'min_length'    => 'Kolom password minimal harus 8 karakter.',
      ],
      'email' => [
        'required'      => 'Kolom email harus diisi.',
        'is_unique'     => 'Kolom email harus unik.',
        'valid_email'   => 'Masukkan alamat email yang valid.',
      ],
      'role' => [
        'required'      => 'Kolom role harus diisi.',
        'in_list'       => 'Kolom role harus salah satu dari: user, admin.',
      ],
    ];

    $this->validation->setRules($validationRules, $validationMessages);

    if (!$this->validation->withRequest($this->request)->run()) {
      return redirect()->to('createUser')->withInput()->with('validation', $this->validation);
    }

    $data = [
      'username'   => $this->request->getPost('username'),
      'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
      'email'      => $this->request->getPost('email'),
      'role'       => $this->request->getPost('role'),
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ];

    $this->userModel->insert($data);

    return redirect()->to('/');
  }

  public function editUser($id)
  {
    $user = $this->userModel->find($id);
    if (empty($user)) {
      return redirect()->to('/')->with('error', 'User not found');
    }
    return view('user/editUser', ['user' => $user]);
  }


  public function update($id)
  {
    $user = $this->userModel->find($id);

    if (empty($user)) {
      return redirect()->to('/')->with('error', 'User not found');
    }

    $data = [
      'username' => $this->request->getPost('username'),
      'email'    => $this->request->getPost('email'),
      'role'     => $this->request->getPost('role'),
    ];

    $this->userModel->update($id, $data);
    return redirect()->to('/')->with('success', 'User updated successfully');
  }

  public function delete($id)
  {
    $user = $this->userModel->find($id);

    if (empty($user)) {
      return redirect()->to('/')->with('error', 'User not found');
    }
    $this->userModel->delete($id);

    return redirect()->to('/')->with('success', 'User deleted successfully');
  }

  public function master()
  {
    if (session()->get('role') !== 'admin') {
      return redirect()->to('/');
    }
    $adminUsers = $this->userModel->where('role', 'admin')->findAll();
    $userUsers = $this->userModel->where('role', 'user')->findAll();

    $data['adminUsers'] = $adminUsers;
    $data['userUsers'] = $userUsers;

    return view('user/master', $data);
  }

  public function deleteMaster($id)
  {
    $user = $this->userModel->find($id);

    if (empty($user)) {
      return redirect()->to('admin/master')->with('error', 'User not found');
    }
    $this->userModel->delete($id);

    return redirect()->to('admin/master')->with('success', 'User deleted successfully');
  }
}