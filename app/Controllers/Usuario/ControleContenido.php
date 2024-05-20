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
use App\Models\TemarioModel;
use App\Models\UniModel;
use App\Models\UsuarioModel;
use CodeIgniter\HotReloader\HotReloader;
use CodeIgniter\HTTP\Message;
use Kint\Zval\Value;

class ControleContenido extends BaseController
{
    public function index(): string
    {
        $uniModel = new UniModel();
        $unis = $uniModel->findAll();

        $carreraModel = new CarreraModel();
        $carreras = $carreraModel->findAll();

        $materiaModel = new MateriaModel();
        $materias = $materiaModel->findAll();
        $preguntaModel = new preguntaModel();
        $preguntas = $preguntaModel->findAll();

        $temarioModel = new TemarioModel();
        $temarios = $temarioModel->findAll();

        $usuarioModel = new UsuarioModel();
        $users = $usuarioModel->findAll();

        $data = ['unis' => $unis, 'carreras' => $carreras, 'materias' => $materias, 'temarios' => $temarios, 'preguntas' => $preguntas, 'users'=>$users];

        return view('user/inicioContenido', $data);
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
}