<?php

namespace App\Controllers\Usuario;

use App\Controllers\BaseController;

use App\Models\MateriaPreguntaModel;
use App\Models\CarreraModel;
use App\Models\MateriaModel;
use App\Models\LibroModel;
use App\Models\MateriaLibroModel;
use App\Models\MateriaTemarioModel;
use App\Models\PreguntaModel;
use App\Models\TemaModel;
use App\Models\TemarioModel;
use App\Models\UniModel;
use App\Models\UsuarioModel;
use CodeIgniter\HotReloader\HotReloader;
use CodeIgniter\HTTP\Message;
use Kint\Zval\Value;

class ControleUser extends BaseController
{
    public function index()
    {
        $session = session(); // Accede al servicio de sesiones
        $idseccion = $session->get('tipo');
        if ($idseccion == 1) {
            return view('user/inicio');
        } else {
            if ($idseccion == 2) {
                return redirect()->to(base_url() . '/inicioAdmi');
            } else {
                return view('user/inicio');
            }
        }
    }
    public function material()
    {
        return view('user/material');
    }
    public function examen()
    {
        return view('user/examen');
    }
    public function comunidad()
    {
        return view('user/comunidad');
    }
    //INICIAR SESION
    public function iniciarSesion()
    {
        return view('user/login');
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
    
        // Loguear los valores en la consola del servidor
        error_log("Correo: " . $correo);
        error_log("Password: " . $password);
    
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
    
        // Loguear valores adicionales en la consola del servidor
        error_log("Usuario ID: " . $idU);
        error_log("Usuario Nombre: " . $user->nombre);
        error_log("Usuario Correo: " . $user->correo);
        error_log("Usuario Imagen: " . $imgUsuario);
    
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
    

    public function preguntasAjax()
    {
        $idTema = $this->request->getPost('idTema');
        $preguntaModel = new PreguntaModel();
        $preguntas = $preguntaModel->where('idTema', $idTema)->findAll();
        return json_encode($preguntas);
    }

    //FUNCION PARA CERRAR SESION
    public function logout()
    {
        // Eliminar todos los datos de la sesión
        session()->destroy();

        // Redirigir al usuario a la página de inicio de sesión o a cualquier otra página deseada
        return redirect()->to('/')->with('msg', 'Sesión Cerrada Correctamente');
    }

    //FUNCION PARA EXAMEN
    public function examenGE($idCarrera)
{ 
    $carreraModel = new CarreraModel();
    $materiaModel = new MateriaModel();
    $temaModel = new TemaModel();
    $preguntaModel = new PreguntaModel();

    $carreras = $carreraModel->where('idU', 1)->findAll();

    $datosCarreraUniversidad = [];
    foreach ($carreras as $carrera) {
        $idCarrera = $carrera['idCarrera'];
        $materias = $materiaModel->where('idCarrera', $idCarrera)->findAll();
        foreach ($materias as $materia) {
            $idMateria = $materia['idMateria'];
            $temas = $temaModel->select('tema.idTema, tema.nombreTema, tema.descripcionTema, tema.videoTema')
                ->join('temario_tema', 'tema.idTema = temario_tema.idTema')
                ->join('temario', 'temario_tema.idTemario = temario.idTemario')
                ->join('materia', 'temario.idMateria = materia.idMateria')
                ->where('materia.idMateria', $idMateria)
                ->findAll();

            foreach ($temas as &$tema) {
                $preguntas = $preguntaModel->where('idTema', $tema['idTema'])->findAll();
                $tema['preguntas'] = $preguntas;
            }

            $datosCarreraUniversidad[$carrera['nombreCarrera']][$materia['nombreMateria']] = $temas;
        }
    }

    $data = ['datosCarreraUniversidad' => $datosCarreraUniversidad];
    return view('user/examenGE', $data);
}

    }
