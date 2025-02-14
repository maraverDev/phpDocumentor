<?php

namespace App\Controllers;

use App\Models\UserModel; // Importamos el modelo de usuarios para interactuar con la base de datos.

/**
 * [Description AuthController]
 */
class AuthController extends BaseController
{
    /**
     * Muestra el formulario de registro de usuario.
     */
    public function register()
    {
        return view('Forms/register'); // Carga y retorna la vista del formulario de registro.
    }

    /**
     * Procesa el registro de un nuevo usuario.
     */
    public function processRegister()
    {
        helper(['form', 'url']); // Carga los helpers necesarios para trabajar con formularios y URLs.

        // Configuración de las reglas de validación del formulario.
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'surname' => 'required|min_length[3]|max_length[50]', // Validación para el apellido
            'email' => 'required|valid_email|is_unique[users.email]',
            'gender' => 'required|in_list[Male,Female,Other]', // Género obligatorio
            'born_date' => 'required|valid_date[Y-m-d]', // Fecha de nacimiento válida
            'phone_number' => 'required|numeric|min_length[9]|max_length[15]', // Número de teléfono válido
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        // Si la validación falla, volvemos a mostrar el formulario con los errores.
        if (!$this->validate($rules)) {
            return view('Forms/register', [
                'validation' => $this->validator, // Pasamos los errores de validación a la vista.
            ]);
        }

        // Si la validación pasa, procedemos a guardar el usuario en la base de datos.
        $userModel = new UserModel();
        $userModel->save([
            'NAME' => $this->request->getPost('name'),
            'SURNAME' => $this->request->getPost('surname'),
            'EMAIL' => $this->request->getPost('email'),
            'GENDER' => $this->request->getPost('gender'),
            'BORN_DATE' => $this->request->getPost('born_date'),
            'PHONE_NUMBER' => $this->request->getPost('phone_number'),
            'PASSWORD' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);

        // Redirigimos al formulario de inicio de sesión con un mensaje de éxito.
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('success', 'Has sido registrado con éxito');
        } else {
            return redirect()->to('/dashboard')->with('success', 'Usuario añadido correctamente');
        }
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function login()
    {
        return view('Forms/login'); // Carga y retorna la vista del formulario de inicio de sesión.
    }

    /**
     * Procesa el inicio de sesión del usuario.
     */
    public function processLogin()
    {
        helper(['form', 'url']); // Carga los helpers necesarios para trabajar con formularios y URLs.
        $session = session(); // Inicia una sesión para el usuario.

        // Configuración de las reglas de validación del formulario.
        $rules = [
            'email' => 'required|valid_email', // El correo es obligatorio y debe ser válido.
            'password' => 'required', // La contraseña es obligatoria.
        ];

        // Si la validación falla, volvemos a mostrar el formulario con los errores.
        if (!$this->validate($rules)) {
            return view('Forms/login', [
                'validation' => $this->validator, // Pasamos los errores de validación a la vista.
            ]);
        }

        // Si la validación pasa, verificamos las credenciales.
        $userModel = new UserModel();
        $user = $userModel->findByEmail($this->request->getPost('email')); // Buscamos al usuario por su correo.
        if ($user && password_verify($this->request->getPost('password'), $user['PASSWORD']) && is_null($user['deleted_at'])) {
            $session->set([
                'id' => $user['ID_USER'],
                'name' => $user['NAME'],
                'email' => $user['EMAIL'],
                'isLoggedIn' => true,
                'created_at' => $user['created_at'],
            ]);
            return redirect()->to('/dashboard')->with('success', 'Inicio de sesión exitoso.');
        } else if ($user && !is_null($user['deleted_at'])) {
            return redirect()->to('/login')->with('error', 'Este usuario está dado de baja, para más información llame al 612 987 123');
        }


        // Si las credenciales son incorrectas, mostramos un mensaje de error.
        return redirect()->to(uri: '/login')->with('error', 'Correo o contraseña incorrectos.');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout()
    {
        $session = session(); // Inicia o accede a la sesión.
        $session->destroy(); // Destruye todos los datos de la sesión.

        // Redirige al formulario de inicio de sesión con un mensaje de éxito.
        return redirect()->to('/login')->with('success', 'Has cerrado sesión correctamente.');
    }
    public function delete($ID_USER)
    {
        $userModel = new UserModel();

        // Verificamos si el usuario existe.
        $user = $userModel->find($ID_USER);
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'Usuario no encontrado.');
        }

        // Establecer la fecha de desactivación (baja) al momento de la operación.
        $data = [
            'deleted_at' => date('Y-m-d H:i:s'), // Fecha actual de desactivación
        ];

        // Intentamos actualizar el usuario.
        $updated = $userModel->update($ID_USER, $data);

        // Verificamos si la actualización fue exitosa
        if (!$updated) {
            return redirect()->to('/dashboard')->with('error', 'Error al desactivar el usuario.');
        }

        // Redirigir a la vista con un mensaje de éxito.
        return redirect()->to('/dashboard')->with('success', 'Usuario desactivado correctamente.');
    }

    /**
     * Muestra el formulario de edición de usuario.
     *
     * @param int $ID_USER El ID del usuario a editar.
     */
    public function edit($ID_USER)
    {
        $userModel = new UserModel();

        // Buscamos al usuario por ID.
        $user = $userModel->find($ID_USER);

        // Si el usuario no existe, redirigir con un error.
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'Usuario no encontrado.');
        }

        // Pasamos los datos del usuario a la vista de edición.
        return view('Forms/edit_user', [
            'user' => $user,
        ]);
    }

    /**
     * Procesa la actualización de un usuario existente.
     *
     * @param int $ID_USER El ID del usuario a actualizar.
     */
    public function update($ID_USER)
    {
        helper(['form', 'url']); // Carga los helpers necesarios.
        $userModel = new UserModel();

        // Verificamos si el usuario existe.
        $user = $userModel->find($ID_USER);
        if (!$user) {
            return redirect()->to('/dashboard')->with('error', 'Usuario no encontrado.');
        }

        // Configuración de las reglas de validación.
        $rules = [
            'name' => 'required|min_length[3]|max_length[50]',
            'surname' => 'required|min_length[3]|max_length[50]',
            'email' => "required|valid_email|is_unique[users.EMAIL,ID_USER,{$ID_USER}]",
            'gender' => 'required|in_list[Male,Female,Other]',
            'born_date' => 'required|valid_date[Y-m-d]',
            'phone_number' => 'required|numeric|min_length[9]|max_length[15]',
        ];

        // Validación del formulario.
        if (!$this->validate($rules)) {
            return view('Forms/edit_user', [
                'validation' => $this->validator,
                'user' => $user,
            ]);
        }

        // Actualizamos los datos del usuario.
        $userModel->update($ID_USER, [
            'NAME' => $this->request->getPost('name'),
            'SURNAME' => $this->request->getPost('surname'),
            'EMAIL' => $this->request->getPost('email'),
            'GENDER' => $this->request->getPost('gender'),
            'BORN_DATE' => $this->request->getPost('born_date'),
            'PHONE_NUMBER' => $this->request->getPost('phone_number'),
        ]);


        // Redirigimos con un mensaje de éxito.
        return redirect()->to('/dashboard')->with('success', 'Usuario actualizado correctamente.');
    }
}
