<?php

namespace App\Controllers;

use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        // Verificar si el usuario ha iniciado sesión
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Por favor, inicia sesión para acceder al Dashboard.');
        }

        // Obtener los datos de los usuarios
        $userModel = new UserModel();

        $name = $this->request->getVar('name');
        $query = $userModel;

        // Filtrar usuarios activos (sin fecha de desactivación)
        $query = $query->where('deleted_at', NULL);

        // Si se pasa un nombre, buscarlo en los usuarios
        if ($name) {
            $query = $query->like('name', $name);
        }

        $perPage = 3;
        $data['users'] = $query->paginate($perPage); // Recupera los usuarios con paginación.
        $data['pager'] = $userModel->pager;             // Obtiene el objeto de paginación.
        $data['name'] = $name;
        $data['totalUsers'] = $userModel->countAllResults(); // Total de usuarios para mostrar

        // Cargar la vista del Dashboard con los datos de los usuarios
        return view('Lists/dashboard', $data);
    }
}
