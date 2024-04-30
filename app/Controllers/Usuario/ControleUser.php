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
         return view('user/inicioUser');
     }
 
     public function login()
     {
         // Validar campos de entrada
         $rules = [
             'correo' => 'required',
             'password' => 'required'
         ];
         if (!$this->validate($rules)) {
             // Si la validación falla, redirige de vuelta con errores y datos de entrada
             return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
         }
     
         // Obtener datos del formulario
         $correo = $this->request->getVar('correo');
         $password = md5($this->request->getVar('password')); // Encriptar contraseña con MD5
     
         // Obtener el modelo de usuario
         $usuariomodel = model('UsuarioModel');
     
         // Buscar el usuario por el correo
         $user = $usuariomodel->getUserBy('correo', $correo);
         if (!$user) {
             // Si el usuario no existe, mostrar mensaje de error y redirigir de vuelta
             return redirect()->back()->with('msg', 'El correo ingresado no está registrado en el sistema');
         }
         // Verificar la contraseña
         if ($password !== $user->password) {
             // Si la contraseña es incorrecta, mostrar mensaje de error y redirigir de vuelta
             return redirect()->back()->with('msg', 'Contraseña incorrecta');
         }

         // Iniciar sesión
         session()->set([
             'idUsuario' => $user->idUsuario,
             'correo' => $user->correo,
             'nombre' => $user->nombre,
             'tipo' => $user->tipo,
             'is_logged' => true
         ]);
     
         // Redirigir al usuario a la página de inicio
         return redirect()->to('/')->with('msg', 'Bienvenido, ' );
        }
     

    //FUNCION PARA CERRAR SESION
    public function logout()
    {
        // Eliminar todos los datos de la sesión
        session()->destroy();
    
        // Redirigir al usuario a la página de inicio de sesión o a cualquier otra página deseada
        return redirect()->to('/')->with('msg', 'Sesión Cerrada Correctamente' );
    }


    //SELECT DE LOS CARRERAS EXISTENTES
    public function carreras()
    {
        //con esto se podra ver todas las materias que se tienen
        $carreraModel = new CarreraModel();
        $carreras = $carreraModel->findAll();

        $data = ['carreras' => $carreras, 'titulo' => "Nuestras Carreras "];
        return view('header/1header', $data) .
            view('barraNavegacion/barra1') .
            view('user/2carreras') .
            view('footer/1footer');
    }

    //SELECT DE LAS MATERIAS EXISTENTES DEL CURSO
    public function materia($idCarrera)
    {
        $materiaModel = new MateriaModel();
        $carreras = $materiaModel->where('idCarrera', $idCarrera)->findAll();


        //nombre del titulo
        $carreraModel = new CarreraModel();
        $titulo = $carreraModel->find($idCarrera);

        $data = ['carreras' => $carreras, 'titulo' => $titulo];
        return view('header/1header', $data) .
            view('barraNavegacion/barra1') .
            view('user/3materia') .
            view('footer/1footer');
    }



    //MOSTRAR LA BIBLIOGRAFIA EXISTENTE DE LA MATERIA 
    public function bibliografia($idMateria)
    {
        $materiaModel = new MateriaModel();
        $titulo = $materiaModel->find($idMateria);

        $libroModel = new LibroModel();
        $result = $libroModel
            ->select('libro.nombreLibro,libro.descripcionLibro,libro.imagenLibro,pdfLibro,ml.idMateria')
            ->join('materia_libro ml', 'libro.idLibro = ml.idLibro')
            ->where('ml.idMateria', $idMateria);
        $libros = $result->findAll();

        $data = ['libros' => $libros, 'titulo' => $titulo];

        return view('header/1header', $data) .
            view('barraNavegacion/barra1') .
            view('user/4bibliografia') .
            view('footer/1footer');
    }
    
}
