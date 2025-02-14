<?php


namespace App\Controllers;


class Home extends BaseController
{
    public function index()
    {
        return view('custom_view');
    }

    public function getUsers()
    {
        $userModel = new \App\Models\UserModel();
        $users = $userModel->findAll();
        return view('dashboard', ['users' => $users]);
    }

    public function create()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]'
            ];
            $messages = [
                'name' => [
                    'required' => 'El campo Nombre es obligatorio',
                    'min_length' => 'El nombre debe tener al menos 3 caracteres',
                    'max_length' => 'El nombre no puede exceder los 100 caracteres',
                ],
                'email' => [
                    'required' => 'El campo Correo electronico es obligatorio',
                    'valid_email' => 'El correo no tiene un formato valido.',
                    'is_unique' => 'El correo electronico ya esta registrado',
                ]
            ];
            if (!$this->validate($rules, $messages)) {
                return view('register', [
                    'validation' => $this->validator,
                ]);
            } else {
                $userModel = new \App\Models\UserModel();
                $userModel -> save ([
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                ]);
                return redirect()->to('/home');

            }
        }
        return view('register');
    }
}
