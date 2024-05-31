<?php

namespace App\Controllers\Admi;

use App\Controllers\BaseController;

use App\Models\MateriaPreguntaModel;
use App\Models\CarreraModel;
use App\Models\MateriaModel;
use App\Models\LibroModel;
use App\Models\MateriaLibroModel;
use App\Models\TemarioTemaModel;
use App\Models\PreguntaModel;
use App\Models\TemarioModel;
use App\Models\TemaModel;
use App\Models\UniModel;
use App\Models\UsuarioModel;
use CodeIgniter\HotReloader\HotReloader;
use CodeIgniter\HTTP\Message;
use Kint\Zval\Value;

class ControleAdmi extends BaseController
{
  protected $db;

  public function __construct()
  {
    // Obtener una instancia de la base de datos
    $this->db = \Config\Database::connect();
  }

  //----------------------------------------------------------------INICIO DEL SISTEMA----------------------------------------------------------------

  public function index(): string
  {
    $uniModel = new UniModel();
    $unis = $uniModel->findAll();

    $carreraModel = new CarreraModel();
    $carreras = $carreraModel->join('uni', 'uni.idU = carrera.idU')
      ->orderBy('carrera.idU')
      ->findAll();

    $materiaModel = new MateriaModel();
    $materias = $materiaModel->join('carrera', 'carrera.idCarrera = materia.idCarrera')
      ->orderBy('materia.idCarrera')
      ->findAll();

    $temarioModel = new TemarioModel();
    $temarios = $temarioModel->join('materia', 'materia.idMateria = temario.idMateria')
      ->orderBy('temario.idMateria')
      ->findAll();

    $temaModel = new TemaModel();
    $tema = $temarioModel->findAll();

    $preguntaModel = new preguntaModel();
    $preguntas = $preguntaModel->findAll();

    $data = ['unis' => $unis, 'carreras' => $carreras, 'materias' => $materias, 'temarios' => $temarios, 'preguntas' => $preguntas, 'tema' => $tema];

    return view('adm/inicioAdmi', $data);
  }
  //Cerrar sesión
  public function logout()
  {
    $session = session();
    $session->destroy(); // Destruye la sesión actual
    return redirect()->to(base_url()); // Redirige a la página de inicio de sesión
  }
  #################--SELECT--#####################
  public function universidadAjax()
  {
    $uniModel = new UniModel();
    $unis = $uniModel->findAll();
    return json_encode($unis);
  }
  #################--DELETE--#####################
  public function eliminarUni()
  {
    $idU = $this->request->getPost('idU');

    $uniModel = new UniModel();
    $uniModel->delete($idU);
  }

  public function crearUni()
  {

    $data = [
      'nombreU' => $this->request->getPost('nombreU'),
      'descripcionU' => $this->request->getPost('descripcionU'),
      'imagenU' => $this->request->getPost('imagenU'),
    ];

    //instanciar
    $uniModel = new UniModel();
    $uniModel->insert($data);
  }

  public function editarUni()
  {
    $idU = $this->request->getPost('idU');

    $data = [
      'nombreU' => $this->request->getPost('nombreU'),
      'descripcionU' => $this->request->getPost('descripcionU'),
      'imagenU' => $this->request->getPost('imagenU'),
    ];

    //instanciar
    $uniModel = new UniModel();
    $uniModel->update($idU, $data);
  }

  public function carreraAjax()
  {
    $idU = $this->request->getPost('idU');
    $carreraModel = new CarreraModel();
    $carreras = $carreraModel->where('idU', $idU)->findAll();

    // Devolver los temas como JSON
    return json_encode($carreras);
  }
  public function allCarreras()
  {

    $carreraModel = new CarreraModel();
    $carreras = $carreraModel->findAll();

    // Devolver los temas como JSON
    return json_encode($carreras);
  }


  //INSERT DE LAS CARRERAS 
  public function crearCarrera()
  {
    $idU = $this->request->getPost('idU');

    $data = [
      'idU' => $idU,
      'nombreCarrera' => $this->request->getPost('nombreCarrera'),
      'descripcionCarrera' => $this->request->getPost('descripcionCarrera'),
      'imagenCarrera' => $this->request->getPost('imagenCarrera'),
    ];

    //instanciar
    $carreraModel = new CarreraModel();
    $carreraModel->insert($data);
  }

  //UPDATE CARRERA
  public function editarCarrera()
  {
    $idCarrera = $this->request->getPost('idCarrera');

    $data = [
      'nombreCarrera' => $this->request->getPost('nombreCarrera'),
      'descripcionCarrera' => $this->request->getPost('descripcionCarrera'),
      'imagenCarrera' => $this->request->getPost('imagenCarrera'),
    ];

    //instanciar
    $carreraModel = new CarreraModel();
    $carreraModel->update($idCarrera, $data);
  }

  //DELETE DE LAS CARRERAS EXISTENTES
  public function eliminarCarrera()
  {
    $idCarrera = $this->request->getPost('idCarrera');

    $carreraModel = new CarreraModel();
    $carreraModel->delete($idCarrera);
  }


  public function materiaAjax()
  {
    $idCarrera = $this->request->getPost('idCarrera');
    $materiaModel = new MateriaModel();
    $materias = $materiaModel->where('idCarrera', $idCarrera)->findAll();


    return json_encode($materias);
  }

  //INSERT DE LAS MATERIAS
  public function crearMateria()
  {

    $idCarrera = $this->request->getPost('idCarrera');


    $data = [
      'nombreMateria' => $this->request->getPost('nombreMateria'),
      'descripcionMateria' => $this->request->getPost('descripcionMateria'),
      'imagenMateria' => $this->request->getPost('imagenMateria'),
      'idCarrera' => $idCarrera,
    ];

    //instanciar
    $materiaModel = new materiaModel();
    $materiaModel->insert($data);
  }

  //DELETE DE LAS MATERIAS EXISTENTES
  public function eliminarMateria()
  {
    $idMateria = $this->request->getPost('idMateria');

    // Instanciar el modelo
    $materiaModel = new MateriaModel();

    // Eliminar lógicamente el registro con el ID especificado
    $materiaModel->delete($idMateria);
  }

  //UPDATE MATERIA
  public function editarMateria()
  {
    $idMateria = $this->request->getPost('idMateria');

    $data = [
      'nombreMateria' => $this->request->getPost('nombreMateria'),
      'descripcionMateria' => $this->request->getPost('descripcionMateria'),
      'imagenMateria' => $this->request->getPost('imagenMateria'),
    ];

    //instanciar
    $materiaModel = new materiaModel();
    $materiaModel->update($idMateria, $data);
  }

  //#######################-TEMARIO-#########################################
  public function temarioMateria()
  {
    $idMateria = $this->request->getPost('idMateria');
    $temarioModel = new TemarioModel();
    $temarios = $temarioModel->where('idMateria', $idMateria)->findAll();
    return json_encode($temarios);
  }


  //INSERT DE LAS MATERIAS
  public function crearTemario()
  {

    $idMateria = $this->request->getPost('idMateria');

    $data = [
      'nombreTemario' => $this->request->getPost('nombreTemario'),
      'contenidoTemario' => $this->request->getPost('contenidoTemario'),
      'libroTemario' => $this->request->getPost('libroTemario'),
      'idMateria' => $idMateria,
    ];

    //instanciar
    $temarioModel = new TemarioModel();
    $temarioModel->insert($data);
  }

  //DELETE DE LAS MATERIAS EXISTENTES
  public function eliminarTemario()
  {
    $idTemario = $this->request->getPost('idTemario');

    $temarioModel = new TemarioModel();
    $temarioModel->delete($idTemario);
  }

  //UPDATE MATERIA
  public function modificarTemario()
  {
    $idTemario = $this->request->getPost('idTemario');

    $data = [
      'nombreTemario' => $this->request->getPost('nombreTemario'),
      'contenidoTemario' => $this->request->getPost('contenidoTemario'),
      'libroTemario' => $this->request->getPost('libroTemario'),
      'idMateria' => $this->request->getPost('idMateria'),
    ];

    //instanciar
    $temarioModel = new TemarioModel();
    $temarioModel->update($idTemario, $data);
  }

  public function temaCarrera()
  {
    $idMateria = $this->request->getPost('idMateria');

    $temaModel = new TemaModel();
    $temas = $temaModel->select('tema.idTema, tema.nombreTema, tema.descripcionTema, tema.videoTema')
      ->join('temario_tema', 'tema.idTema = temario_tema.idTema')
      ->join('temario', 'temario_tema.idTemario = temario.idTemario')
      ->join('materia', 'temario.idMateria = materia.idMateria')
      ->where('materia.idMateria', $idMateria)
      ->findAll();
    return json_encode($temas);
  }

  #################--SELECT--#####################
  public function preguntasAjax()
  {
    $idTema = $this->request->getPost('idTema');
    $preguntaModel = new PreguntaModel();
    $preguntas = $preguntaModel->where('idTema', $idTema)->findAll();
    return json_encode($preguntas);
  }


  public function crearPregunta()
  {
    $data = [
      'enunciado' => $this->request->getPost('enunciado'),
      'grafico' => $this->request->getPost('grafico'),
      'a' => $this->request->getPost('a'),
      'b' => $this->request->getPost('b'),
      'c' => $this->request->getPost('c'),
      'd' => $this->request->getPost('d'),
      'e' => $this->request->getPost('e'),
      'respuesta' => $this->request->getPost('respuesta'),
      'idTema' => $this->request->getPost('idTema'),
      'dificultad' => $this->request->getPost('dificultad'),
      'resolucionPDF' => $this->request->getPost('resolucionPDF'),
    ];

    // Insertar en la tabla pregunta
    $preguntaModel = new PreguntaModel();
    $preguntaModel->insert($data);
  }


  //UPDATE PREGUNTA
  public function modificarPregunta()
  {

    $idPregunta = $this->request->getPost('idPregunta');

    $data = [
      'enunciado' => $this->request->getPost('enunciado'),
      'grafico' => $this->request->getPost('grafico'),
      'a' => $this->request->getPost('a'),
      'b' => $this->request->getPost('b'),
      'c' => $this->request->getPost('c'),
      'd' => $this->request->getPost('d'),
      'e' => $this->request->getPost('e'),
      'respuesta' => $this->request->getPost('respuesta'),
      'idTema' => $this->request->getPost('idTema'),
      'dificultad' => $this->request->getPost('dificultad'),
      'resolucionPDF' => $this->request->getPost('resolucionPdf'),
    ];

    //instanciar
    $preguntaModel = new PreguntaModel();
    $preguntaModel->update($idPregunta, $data);
  }
  //----------------------------------------------------------------Preguntas---------------------------------------------------------------

  //INSERT DE LAS PREGUNTAS

  public function eliminarPregunta()
  {

    $idPregunta = $this->request->getPost('idPregunta');

    $preguntaModel = new PreguntaModel();
    $preguntaModel->delete($idPregunta);
  }

  #################--SELECT--#####################
  public function temaTemario()
  {
    $idTemario = $this->request->getPost('idTemario');
    $temaModel = new TemaModel();
    $tema = $temaModel
      ->select('tema.idTema, tema.nombreTema, tema.descripcionTema, tema.videoTema')
      ->join('temario_tema', 'tema.idTema = temario_tema.idTema')
      ->where('temario_tema.idTemario', $idTemario)
      ->findAll();

    return json_encode($tema);
  }


  public function crearTema()
  {

    $data = [
      'nombreTema' => $this->request->getPost('nombreTema'),
      'descripcionTema' => $this->request->getPost('descripcionTema'),
      'videoTema' => $this->request->getPost('videoTema'),
    ];
    //Insertar tema
    $temaModel = new TemaModel();
    $temaModel->insert($data);
    // Obtener el ID del último registro insertado
    $idTema = $temaModel->insertID();
    $idTemario = $this->request->getPost('idTemario');

    // Crear instancia del modelo TemarioTemaModel
    $temarioTemaModel = new TemarioTemaModel();
    // Insertar la relación entre temario y tema
    $temarioTemaModel->insertarRelacionTemaTemario($idTemario, $idTema);
  }

  public function agregarTema()
  {
    $idTema =  $this->request->getPost('idTema');
    $idTemario = $this->request->getPost('idTemario');

    // Crear instancia del modelo TemarioTemaModel
    $temarioTemaModel = new TemarioTemaModel();
    // Insertar la relación entre temario y tema
    $temarioTemaModel->insertarRelacionTemaTemario($idTemario, $idTema);
  }



  //UPDATE PREGUNTA
  public function modificarTema()
  {

    $idTema = $this->request->getPost('idTema');

    $data = [
      'nombreTema' => $this->request->getPost('nombreTema'),
      'descripcionTema' => $this->request->getPost('descripcionTema'),
      'videoTema' => $this->request->getPost('videoTema'),
    ];

    //instanciar
    $temaModel = new TemaModel();
    $temaModel->update($idTema, $data);
  }
  //----------------------------------------------------------------Preguntas---------------------------------------------------------------

  //INSERT DE LAS PREGUNTAS

  public function eliminarTema()
  {

    // Obtener el ID del último registro insertado
    $idTema = $this->request->getPost('idTema');
    $idTemario = $this->request->getPost('idTemario');

    // Crear instancia del modelo TemarioTemaModel
    $temarioTemaModel = new TemarioTemaModel();
    // Insertar la relación entre temario y tema
    $temarioTemaModel->eliminarRelacion($idTemario, $idTema);
  }
  //----------------------------------------------------------------Password---------------------------------------------------------------

  public function pas($idUsuario, $contrasena)
  {
    $data = ['password' => password_hash($contrasena, PASSWORD_DEFAULT)];

    $usuarioModel = new UsuarioModel();

    // Actualizar la contraseña del usuario en la base de datos
    if ($usuarioModel->update($idUsuario, $data)) {
      // La actualización fue exitosa
      echo "EXITOSAMENTE EXITOSO :D";
    } else {
      // Hubo un error durante la actualización
      echo "Hubo un error al actualizar la contraseña";
    }
  }
}
