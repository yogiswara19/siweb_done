<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel();
    }

    public function index()
    {
        $dataUser = $this->userModel->getUsers();
        $data = [
            'title'  => 'Data User',
            'result' => $dataUser
        ];
        return view('user/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah User'
        ];
        return view('user/create', $data);
    }

    public function save()
    {
        $user_myth = new UsersModel();
        $user_myth->save([
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'user_name' => $this->request->getVar('user_name'),
            'user_email' => $this->request->getVar('user_email'),
            'role' => $this->request->getVar('role'),
            'user_password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ]);
        session()->setFlashdata('msg', 'Berhasil menambah user!');
        return redirect()->to('/users');
    }

    public function edit($id)
    {
        $dataUser = $this->userModel->getUsers($id);
        $data = [
            'title'  => 'Ubah User',
            'result' => $dataUser,
        ];
        return view('user/edit', $data);
        // dd($this->userModel->getUsers($id));
    }

    public function update($id)
    {
        $user_myth = new UsersModel();
        // dd($this->request->getVar('username'));
        $this->userModel->save([
            'id' => $id,
            'firstname' => $this->request->getVar('firstname'),
            'lastname' => $this->request->getVar('lastname'),
            'user_name' => $this->request->getVar('user_name'),
            'user_email' => $this->request->getVar('user_email'),
            'role' => $this->request->getVar('role'),
        ]);

        session()->setFlashdata('msg', 'Berhasil memperbaharui user!');
        return redirect()->to('/users');
    }

    public function delete($id)
    {
        $this->userModel->delete($id);
        session()->setFlashdata("msg", "Data Berhasil dihapus!");
        return redirect()->to('/users');
    }
}
