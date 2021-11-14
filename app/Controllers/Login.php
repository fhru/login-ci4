<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
    }
    public function index()
    {
        return view('auth/login');
    }

    public function postlogin()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $row = $this->UserModel->getData($username);

        if ($row == null) {
            return redirect()->to('/login');
        }
        // dd($row->password);
        if (password_verify($password, $row->password)) {
            $data = [
                'log' => true,
                'username' => $row->username,
                'level' => $row->level
            ];
            session()->set($data);
            return redirect()->to('/');
        }
        return redirect()->to('/register');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function postregister()
    {
        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'nama' => $this->request->getVar('nama'),
            'username' => $this->request->getVar('username'),
            'password' => $password,
            'level' => $this->request->getVar('level')
        ];

        $this->UserModel->insert($data);
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
