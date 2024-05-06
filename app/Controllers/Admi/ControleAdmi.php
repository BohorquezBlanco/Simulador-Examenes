<?php

namespace App\Controllers\Admi;

use App\Controllers\BaseController;

use App\Models\MateriaPreguntaModel;
use App\Models\CarreraModel;
use App\Models\ExamenModel;
use App\Models\MateriaModel;
use App\Models\LibroModel;
use App\Models\MateriaLibroModel;
use App\Models\MateriaTemaModel;
use App\Models\MateriaTemarioModel;
use App\Models\MateriaVideoModel;
use App\Models\PreguntaModel;
use App\Models\TemaModel;
use App\Models\TemarioModel;
use App\Models\UniModel;
use App\Models\UsuarioModel;
use App\Models\VideoModel;
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

  public function index()
  {
    $uniModel = new UniModel();
    $unis = $uniModel->findAll();

    $carreraModel = new CarreraModel();
    $carreras = $carreraModel->findAll();

    $materiaModel = new MateriaModel();
    $materias = $materiaModel->findAll();
  
    $libroModel = new libroModel();
    $libros = $libroModel->findAll();

    $preguntaModel = new preguntaModel();
    $preguntas = $preguntaModel->findAll();

    $temarioModel = new TemarioModel();
    $temarios = $temarioModel->findAll();

    $usuarioModel = new UsuarioModel();
    $users = $usuarioModel->findAll();

    $data = ['unis' => $unis, 'carreras' => $carreras, 'materias' => $materias, 'temarios' => $temarios, 'libros' => $libros, 'preguntas' => $preguntas, 'users'=>$users];

    return view('adm/1inicioAdmi', $data);
  }

  //----------------------------------------------------------------Univ o Inst----------------------------------------------------------------
  //INSERT DE Univ o inst 
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

    return redirect()->to('inicioAdmi');
  }

  //UPDATE Univ o inst 
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
    return redirect()->to('inicioAdmi');
  }

  //DELETE DE LAS Univ o inst existentes
  public function eliminarUni()
  {
    $idU = $this->request->getPost('id');

    $uniModel = new UniModel();
    $uniModel->delete($idU);

    return redirect()->to('inicioAdmi');
  }


  //----------------------------------------------------------------CARRERAS----------------------------------------------------------------
  //INSERT DE LAS CARRERAS 
  public function crearCarrera()
  {
    $data = [
      'idU' => $this->request->getPost('idU'),
      'nombreCarrera' => $this->request->getPost('nombreCarrera'),
      'descripcionCarrera' => $this->request->getPost('descripcionCarrera'),
      'imagenCarrera' => $this->request->getPost('imagenCarrera'),
    ];

    //instanciar
    $carreraModel = new CarreraModel();
    $carreraModel->insert($data);
    return redirect()->to('inicioAdmi');
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
    return redirect()->to('inicioAdmi');
  }

  //DELETE DE LAS CARRERAS EXISTENTES
  public function eliminarCarrera()
  {
    $idCarrera = $this->request->getPost('id');

    $carreraModel = new CarreraModel();
    $carreraModel->delete($idCarrera);

    return redirect()->to('inicioAdmi');
  }


  //----------------------------------------------------------------MATERIAS----------------------------------------------------------------


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

    return redirect()->to('inicioAdmi');
  }

  //DELETE DE LAS MATERIAS EXISTENTES
  public function eliminarMateria()
  {
    $idMateria = $this->request->getPost('id');

    // Instanciar el modelo
    $materiaModel = new MateriaModel();

    // Eliminar lógicamente el registro con el ID especificado
    $materiaModel->delete($idMateria);

    return redirect()->to('inicioAdmi');
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

    return redirect()->to('inicioAdmi');
  }
   //----------------------------------------------------------------LIBROS----------------------------------------------------------------

  //INSERT DE LOS LIBROS
  public function crearLibro()
  {
    $idMateria = $this->request->getPost('idMateria');

    $dataLibro = [
      'nombreLibro' => $this->request->getPost('nombreLibro'),
      'descripcionLibro' => $this->request->getPost('descripcionLibro'),
      'imagenLibro' => $this->request->getPost('imagenLibro'),
      'pdfLibro' => $this->request->getPost('pdfLibro'),
    ];

    // Insertar en la tabla Libro
    $libroModel = new LibroModel();
    $libroModel->insert($dataLibro);

    $idLibro = $libroModel->insertID();

    // Crear un nuevo objeto del modelo
    $materiaLibroModel = new MateriaLibroModel();
    $materiaLibroModel->insertarRelacionMateriaLibro($idMateria, $idLibro);

    return redirect()->to('inicioAdmi');
  }
  //DELETE LIBRO
  public function eliminarLibro()
  {
    $idMateria = $this->request->getPost('idMateria');
    $idLibro = $this->request->getPost('idLibro');

    $materiaLibroModel = new MateriaLibroModel();
    $materiaLibroModel->eliminarRelacionMateriaLibro($idMateria, $idLibro);

    return redirect()->to('inicioAdmi');
  }

  //UPDATE LIBRO
  public function editarLibro()
  {
    $idMateria = $this->request->getPost('idLibro');
    $idLibro = $this->request->getPost('idLibro');

    $data = [
      'nombreLibro' => $this->request->getPost('nombreLibro'),
      'descripcionLibro' => $this->request->getPost('descripcionLibro'),
      'imagenLibro' => $this->request->getPost('imagenLibro'),
      'pdfLibro' => $this->request->getPost('pdfLibro'),
    ];

    $materiaLibroModel = new MateriaLibroModel();
    // Verificar si la relación ya existe
    if (!$materiaLibroModel->existeRelacion($idMateria, $idLibro)) {

      //instanciar
      $libroModel = new LibroModel();
      $libroModel->update($idLibro, $data);

      $materiaLibroModel->insertarRelacionMateriaLibro($idMateria, $idLibro);
    } else {

      //instanciar
      $libroModel = new LibroModel();
      $libroModel->update($idLibro, $data);
    }

    return redirect()->to('inicioAdmi');
  }

  //----------------------------------------------------------------TEMARIOS---------------------------------------------------------------

  //INSERT DE LOS TEMARIOS
  public function crearTemario()
  {
    $idMateria = $this->request->getPost('idMateria');

    $data = [
      'nombreTemario' => $this->request->getPost('nombreTemario'),
      'descripcionTemario' => $this->request->getPost('descripcionTemario'),
      'pdfTemario' => $this->request->getPost('pdfTemario'),
    ];

    $temarioModel = new TemarioModel();
    $temarioModel->insert($data);
    $idTemario = $temarioModel->insertID();

    $materiaTemarioModel = new MateriaTemarioModel();
    $materiaTemarioModel->insertarRelacionMateriaTema($idMateria, $idTemario);

    return redirect()->to('inicioAdmi');
  }
  //EliminarTema
  public function eliminarTemario()
  {
    $idMateria = $this->request->getPost('idMateria');
    $idTemario = $this->request->getPost('idTemario');

    $materiaTemarioModel = new MateriaTemarioModel();
    $materiaTemarioModel->eliminarRelacionMateriaTema($idMateria, $idTemario);

    $temarioModel = new TemarioModel();
    $temarioModel->delete($idTemario);

    return redirect()->to('inicioAdmi');
  }

  //UPDATE TEMA
  public function editarTemario()
  {
    $idMateria = $this->request->getPost('idMateria');
    $idTemario = $this->request->getPost('idTemario');

    $data = [
      'nombreTemario' => $this->request->getPost('nombreTemario'),
      'descripcionTemario' => $this->request->getPost('descripcionTemario'),
      'pdfTemario' => $this->request->getPost('pdfTemario'),
    ];

    $materiaTemarioModel = new MateriaTemarioModel();
    // Verificar si la relación ya existe
    if (!$materiaTemarioModel->existeRelacion($idMateria, $idTemario)) {

      //instanciar
      $temarioModel = new TemarioModel();
      $temarioModel->update($idTemario, $data);
      $materiaTemarioModel->insertarRelacionMateriaTema($idMateria, $idTemario);
    } else {

      //instanciar
      $temarioModel = new TemarioModel();
      $temarioModel->update($idTemario, $data);
    }

    return redirect()->to('inicioAdmi');
  }

 
  //----------------------------------------------------------------Preguntas---------------------------------------------------------------

  //INSERT DE LAS PREGUNTAS
  public function crearPregunta()
  {
    $idMateria = $this->request->getPost('idMateria');

    $data = [
      'enunciado' => $this->request->getPost('enunciado'),
      'formula' => $this->request->getPost('formula'),
      'grafico' => $this->request->getPost('grafico'),
      'a' => $this->request->getPost('a'),
      'b' => $this->request->getPost('b'),
      'c' => $this->request->getPost('c'),
      'd' => $this->request->getPost('d'),
      'e' => $this->request->getPost('e'),
      'respuesta' => $this->request->getPost('respuesta'),
      'idMateria' => $this->request->getPost('idMateria'),
      'exPas' => $this->request->getPost('exPas'),
      'dificultad' => $this->request->getPost('dificultad'),
      'resolucionPDF' => $this->request->getPost('resolucionPdf'),
      'idTemario' => $this->request->getPost('idTemario'),
    ];

    // Insertar en la tabla pregunta
    $preguntaModel = new PreguntaModel();
    $preguntaModel->insert($data);

    $idPregunta = $preguntaModel->insertID(); // Obtener el ID del tema recién insertado

    // Crear un nuevo objeto del modelo
    $materiaPreguntaModel = new MateriaPreguntaModel();
    $materiaPreguntaModel->insertarRelacionMateriaPregunta($idMateria, $idPregunta);

    return redirect()->to('inicioAdmi');
  }
  public function eliminarPregunta()
  {
    $idMateria = $this->request->getPost('idMateria');
    $idPregunta = $this->request->getPost('idPregunta');

    // Crear un nuevo objeto del modelo
    $materiaPreguntaModel = new MateriaPreguntaModel();
    $materiaPreguntaModel->eliminarRelacionMateriaPregunta($idMateria, $idPregunta);

    $preguntaModel = new PreguntaModel();
    $preguntaModel->delete($idPregunta);

    return redirect()->to('inicioAdmi');
  }

  //UPDATE PREGUNTA
  public function editarPregunta()
  {
    $idMateria = $this->request->getPost('idMateria');
    $idPregunta = $this->request->getPost('idPregunta');

    $data = [
      'enunciado' => $this->request->getPost('enunciado'),
      'formula' => $this->request->getPost('formula'),
      'imagenPregunta' => $this->request->getPost('imagenPregunta'),
      'a' => $this->request->getPost('a'),
      'b' => $this->request->getPost('b'),
      'c' => $this->request->getPost('c'),
      'd' => $this->request->getPost('d'),
      'e' => $this->request->getPost('e'),
      'respuesta' => $this->request->getPost('respuesta'),
      'nombreTemario' => $this->request->getPost('nombreTemario'),
      'exPas' => $this->request->getPost('exPas'),
      'dificultad' => $this->request->getPost('dificultad'),
      'resolucionPDF' => $this->request->getPost('resolucionPdf'),
      'idTemario' => $this->request->getPost('idTemario'),
    ];

    $materiaPreguntaModel = new MateriaPreguntaModel();
    // Verificar si la relación ya existe
    if (!$materiaPreguntaModel->existeRelacion($idMateria, $idPregunta)) {

      //instanciar
      $preguntaModel = new PreguntaModel();
      $preguntaModel->update($idPregunta, $data);
      $materiaPreguntaModel->insertarRelacionMateriaPregunta($idMateria, $idPregunta);
    } else {

      //instanciar
      $preguntaModel = new PreguntaModel();
      $preguntaModel->update($idPregunta, $data);
    }

    return redirect()->to('inicioAdmi');
  }
  //Cerrar sesión
  public function logout()
  {
    $session = session();
    $session->destroy(); // Destruye la sesión actual
    return redirect()->to(base_url()); // Redirige a la página de inicio de sesión
  }


  public function comida()
  {

    $usuarioModel = new UsuarioModel();
    $users = $usuarioModel->findAll();

    $data = [ 'users'=>$users];

    return view('adm/2inicioAdmi', $data);
  }
  #################--SELECT--#####################
  public function univercidadAjax()
  {
    $uniModel = new UniModel();
    $unis = $uniModel->findAll();
    return json_encode($unis);

  }
 #################--DELETE--#####################
  public function eliminarUni2()
  {
    $idU = $this->request->getPost('idU');
 
    $uniModel = new UniModel();
    $uniModel->delete($idU);

  }

  public function crearUni2()
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

  public function editarUni2()
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



 //INSERT DE LAS CARRERAS 
 public function crearCarrera2()
 {
   $data = [
     'idU' => 1,
     'nombreCarrera' => $this->request->getPost('nombreCarrera'),
     'descripcionCarrera' => $this->request->getPost('descripcionCarrera'),
     'imagenCarrera' => $this->request->getPost('imagenCarrera'),
   ];

   //instanciar
   $carreraModel = new CarreraModel();
   $carreraModel->insert($data);

 }

 //UPDATE CARRERA
 public function editarCarrera2()
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
 public function eliminarCarrera2()
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
 public function crearMateria2()
 {

   $idCarrera = 1;

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
 public function eliminarMateria2()
 {
   $idMateria = $this->request->getPost('idMateria');

   // Instanciar el modelo
   $materiaModel = new MateriaModel();

   // Eliminar lógicamente el registro con el ID especificado
   $materiaModel->delete($idMateria);
 }

 //UPDATE MATERIA
 public function editarMateria2()
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
  
}
