<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;

use App\Models\CarreraModel;
use App\Models\MateriaModel;
use App\Models\LibroModel;

class ControleUser extends BaseController
{
    public function index()
    {
        $session = session(); // Accede al servicio de sesiones
        $idseccion = $session->get('tipo');
        if ($idseccion == 1) {
            return view('user/inicioUser');
        } else {
            if ($idseccion == 2) {
                return redirect()->to(base_url() . '/inicioAdmi');
            } else {
                return view('defecto/inicioDefecto');
            }
        }
    }

    //INICIAR SESION
    public function iniciarSesion()
    {
        return view('defecto/login');
    }

public function login()
{
    // Validar campos de entrada
    $rules = [
        'correo' => 'required',
        'password' => 'required'
    ];

    // Obteniendo datos del formulario
    $correo = $this->request->getVar('correo');
    $password = $this->request->getVar('password'); // Obtener la contraseña sin encriptar

    // Validar los campos de entrada
    if (!$this->validate($rules)) {
        // Si la validación falla, redirige de vuelta con errores y datos de entrada
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Obtener el modelo de usuario
    $usuariomodel = model('UsuarioModel');

    // Buscar el usuario por correo
    $user = $usuariomodel->getUserBy('correo', $correo);
    if (!$user) {
        // Si el usuario no existe, mostrar mensaje de error y redirigir de vuelta
        return redirect()->back()->with('msg', 'El correo ingresado no está registrado');
    }

    // Verificar la contraseña
    if (!password_verify($password, $user->password)) {
        // Si la contraseña es incorrecta, mostrar mensaje de error y redirigir de vuelta
        return redirect()->back()->with('msg', 'Contraseña incorrecta');
    }

    // Si el usuario y la contraseña son correctos, obtener la URL de la imagen del usuario
    $imgUsuario = $user->imgUsuario;
    $idU = $user->idUsuario;

    $contU = $user->password;

    // Iniciar sesión
    session()->set([
        'id_usuario' => $idU,
        'correo' => $user->correo,
        'nombre' => $user->nombre,
        'img' => $imgUsuario,
        'cont' => $contU,
        'is_logged' => true
    ]);

    // Redirigir al usuario a la página de inicio
    return redirect()->to('/inicioAdmi')->with('msg', 'Bienvenido, ' . $user->nombre);
}



    //FUNCION PARA CERRAR SESION
    public function logout()
    {
        // Eliminar todos los datos de la sesión
        session()->destroy();

        // Redirigir al usuario a la página de inicio de sesión o a cualquier otra página deseada
        return redirect()->to('/')->with('msg', 'Sesión Cerrada Correctamente');
    }
}
