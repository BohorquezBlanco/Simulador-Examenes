<?php

namespace App\Controllers\Admi;
use App\Controllers\BaseController;

use App\Models\MateriaPreguntaModel;
use App\Models\CarreraModel;
use App\Models\MateriaModel;
use App\Models\LibroModel;
use App\Models\MateriaLibroModel;
use App\Models\PreguntaModel;
use App\Models\TemaModel;
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
       $carreraModel= new CarreraModel();
       $carreras=$carreraModel->findAll();
       $data=['carreras'=>$carreras];
       return view('header/1header').
               view('barraNavegacion/barra2').
               view('adm/1inicio').
               view('footer/1footer');
   }

//----------------------------------------------------------------CARRERAS----------------------------------------------------------------
    //SELECT DE LAS CARRERAS EXISTENTES 
    public function carreras()
    {
       //con esto se podra ver todas las materias que se tienen
       $carreraModel= new CarreraModel();
       $carreras=$carreraModel->findAll();

       $data=['carreras'=>$carreras,'titulo'=>"Nuestras Carreras"];
       return view('header/1header',$data).
               view('barraNavegacion/barra2').
               view('adm/2carreras').
               view('footer/1footer');
    }
    //INSERT DE LAS CARRERAS 
    public function crearCarrera()
    {  
      $data = [
        'nombreCarrera' => $this->request->getPost('nombreCarrera'),
        'descripcionCarrera' => $this->request->getPost('descripcionCarrera'),
        'imagenCarrera'=>$this->request->getPost('imagenCarrera'),
      ];

      //instanciar
      $carreraModel= new CarreraModel();
      $carreraModel->insert($data);
      return redirect()->to('/carreraAdmi');
    } 
    
    //UPDATE CARRERA
    public function editarCarrera()
    {  
      $idCarrera= $this->request->getPost('idCarrera');

      $data = [
      'nombreCarrera' => $this->request->getPost('nombreCarrera'),
      'descripcionCarrera' => $this->request->getPost('descripcionCarrera'),
      'imagenCarrera'=>$this->request->getPost('imagenCarrera'),
      ];
    
      //instanciar
      $carreraModel= new CarreraModel();
      $carreraModel->update($idCarrera,$data);
      return redirect()->to('/carreraAdmi');
    }  

    //DELETE DE LAS CARRERAS EXISTENTES
    public function eliminarCarrera()
    {  
      $idCarrera = $this->request->getPost('idCarrera');
      $codigoEliminacion = $this->request->getPost('codigoEliminacion');
      if ($codigoEliminacion=="123456") 
      {
              // Instanciar el modelo
              $carreraModel = new CarreraModel();
            
              // Eliminar lógicamente el registro con el ID especificado
              $carreraModel->delete($idCarrera);
      }

      return redirect()->to('/carrerasAdmi');
    }


//----------------------------------------------------------------MATERIAS----------------------------------------------------------------
       //SELECT DE LAS MATERIAS EXISTENTES 
       public function materia($idCarrera)
       {
         
           $materiaModel= new MateriaModel();
           $materias = $materiaModel->where('idcarrera', $idCarrera)->findAll();
           
           //nombre del titulo
           $carreraModel= new CarreraModel();
           $titulo=$carreraModel->find($idCarrera);
    
           $data=['materias'=>$materias,'titulo'=>$titulo,'idCarrera'=>$idCarrera];
           return view('header/1header',$data).
                   view('barraNavegacion/barra2').
                   view('adm/3materia').
                   view('footer/1footer');
    
       }

       //INSERT DE LAS MATERIAS
       public function crearMateria()
       {
     
         $idCarrera=$this->request->getPost('idCarrera');
     
         $data = [
           'nombreMateria' => $this->request->getPost('nombreMateria'),
           'descripcionMateria' => $this->request->getPost('descripcionMateria'),
           'imagenMateria'=>$this->request->getPost('imagenMateria'),
           'idCarrera' => $idCarrera,
         ];
     
         //instanciar
         $materiaModel= new materiaModel();
         $materiaModel->insert($data);
     
         return redirect()->to('/materiasAdmi/'.$idCarrera);
       }  
   
       //DELETE DE LAS MATERIAS EXISTENTES
       public function eliminarMateria()
       {  
           $idCarrera = $this->request->getPost('idCarrera');

           $idMateria = $this->request->getPost('idMateria');
       
           // Instanciar el modelo
           $materiaModel = new MateriaModel();
       
           // Eliminar lógicamente el registro con el ID especificado
           $materiaModel->delete($idMateria);
       
           return redirect()->to('/materiasAdmi/'.$idCarrera);

       }
   
       //UPDATE MATERIA
       public function editarMateria()
      {  
          $idMateria= $this->request->getPost('idMateria');
          $idCarrera = $this->request->getPost('idCarrera');

          $data = [
          'nombreMateria' => $this->request->getPost('nombreMateria'),
          'descripcionMateria' => $this->request->getPost('descripcionMateria'),
          'imagenMateria'=>$this->request->getPost('imagenMateria'),
          ];
        
          //instanciar
          $materiaModel= new materiaModel();
          $materiaModel->update($idMateria,$data);
        
          return redirect()->to('/materiasAdmi/'.$idCarrera);

      }  

//----------------------------------------------------------------LIBROS----------------------------------------------------------------
//SELECT DE LOS LIBROS
       public function bibliografia($idMateria)
       {
        $materiaModel= new MateriaModel();
        $titulo=$materiaModel->find($idMateria);

        $materiaValues = $materiaModel->findAll();
        
          // CARGAR TODOS LOS TEMARIOS EXISTENTES DE LA MATERIA
          $libroModel = new libroModel();

          $result = $libroModel
                  ->select('libro.nombreLibro,libro.descripcionLibro,libro.imagenLibro,libro.idLibro,urlLibro,ml.idMateria')
                  ->join('materia_libro ml', 'libro.idLibro = ml.idLibro')
                  ->where('ml.idMateria',$idMateria);
                  $libros= $result->findAll();
          
          $result2 = $libroModel
          ->select('libro.nombreLibro, libro.descripcionLibro, libro.imagenLibro, libro.idLibro, urlLibro, ml.idMateria')
          ->join('materia_libro ml', 'libro.idLibro = ml.idLibro');
              
          // Agregar una condición para excluir $idMateria y otra para incluir valores nulos
          $result2->where('ml.idMateria !=', $idMateria);
          
          $libros2 = $result2->findAll();

           $data=['titulo'=>$titulo,'libros'=>$libros,'libros2'=>$libros2,'idMateria'=>$idMateria, 'materiaV'=>$materiaValues];
           return view('header/1header',$data).
                   view('barraNavegacion/barra2').
                   view('adm/4bibliografia').
                   view('footer/1footer');
    
       }

       //INSERT DE LOS LIBROS
    public function crearLibro()
    {  
      $idMateria=$this->request->getPost('idMateria');
      

      $dataLibro = [ 
        'nombreLibro' => $this->request->getPost('nombreLibro'),
        'descripcionLibro' => $this->request->getPost('descripcionLibro'),
        'imagenLibro'=>$this->request->getPost('imagenLibro'),
        'urlLibro'=>$this->request->getPost('urlLibro'),
      ];

      // Insertar en la tabla Libro
      $libroModel = new LibroModel();
      $libroModel->insert($dataLibro);
      
      $idLibro = $libroModel->insertID();

       // Crear un nuevo objeto del modelo
    $materiaLibroModel = new MateriaLibroModel();

    // Preparar los datos a insertar
    $data = [
        'idMateria' => $idMateria,
        'idLibro' => $idLibro,
    ];

    // Insertar los datos en la tabla
    $materiaLibroModel->insert($data);

      return redirect()->to('/bibliografiaAdm/'.$idMateria);
    }
    
    public function eliminarLibro()
       {  
           $idMateria = $this->request->getPost('idMateria');

           $idLibro = $this->request->getPost('idLibro');
       
           // Instanciar el modelo
           $libroModel = new LibroModel();
       
           // Eliminar lógicamente el registro con el ID especificado
           $libroModel->delete($idLibro);
       
           return redirect()->to('/bibliografiaAdm/'.$idMateria);

       }
   
       //UPDATE MATERIA
       public function editarLibro()
      {  
          $idLibro= $this->request->getPost('idLibro');
          $idMateria = $this->request->getPost('idMateria');

          $data = [
          'nombreLibro' => $this->request->getPost('nombreLibro'),
          'descripcionLibro' => $this->request->getPost('descripcionLibro'),
          'imagenLibro'=>$this->request->getPost('imagenLibro'),
          'urlLibro'=>$this->request->getPost('urlLibro'),
          ];

          //instanciar
          $libroModel= new LibroModel();
          $libroModel->update($idLibro,$data);
        
          return redirect()->to('/bibliografiaAdm/'.$idMateria);

      }  
      public function guardarLibro()
      { 
        $idMateria = $this->request->getPost('idMateriaLibro');
        
        $nombreLibro = $this->request->getPost('nombreLibro');
        $descripcionLibro = $this->request->getPost('descripcionLibro');
        $imagenLibro = $this->request->getPost('imagenLibro');
        $urlLibro = $this->request->getPost('urlLibro');

        $nuevoLibro = new LibroModel();
        $nuevoLibro->insert([
          'nombreLibro' => $nombreLibro,
          'descripcionLibro' => $descripcionLibro,
          'imagenLibro' => $imagenLibro,
          'urlLibro' => $urlLibro,
        ]);
        $idLibroinsertado = $nuevoLibro->insertID();

        // Crear un nuevo objeto del modelo
        $materiaLibroModel = new MateriaLibroModel();

        // Preparar los datos a insertar
        $data = [
            'idMateria' => $idMateria,
            'idLibro' => $idLibroinsertado,
        ];

        // Insertar los datos en la tabla
        $materiaLibroModel->insert($data);

        // Redirecciona de vuelta a la página de bibliografía
        return redirect()->to('/bibliografiaAdm/'.$idMateria);
      }
      
//----------------------------------------------------------------AREA DE REFORZAMIENTO----------------------------------------------------------------
       //SELECT DE LAS MATERIAS EXISTENTES 
       public function bitacorareforzar($idCarrera,$idMateria,$nombreMateria)
       {
    

        //bitacora de creacion de temas preguntas y banco de preguntas
        if ($idMateria==0) {
          //SELECT DE TODOS LOS TEMAS EXISTENTES 
          $temaModel = new TemaModel();
          $temas = $temaModel->findAll();

        }
        if ($idMateria!=0) {
          //esta entrando al area de reforzamiento por materia
          $temaModel = new TemaModel();
          $temas = $temaModel->findAll();

        }

        $data=[
          'temas' => $temas,
          'idMateria' => $idMateria,
          'nombreMateria'=>$nombreMateria,
        ];

           return view('header/1header').
                   view('barraNavegacion/barra2').
                   view('adm/2bitacoraReforzar',$data).
                   view('footer/1footer');
    
       }

       //CARGAR TEMAS
       public function cargarTemas()
       {
           $temaModel = new TemaModel();
           $temas = $temaModel->findAll();
       
           // Devolver los temas como JSON
           return json_encode($temas);
       }


       //INSERT DEL TEMARIO POR AJAX
       public function crearTema()
       {
           // Obtener los datos del formulario
           $data = [
               'nombreTema' => $this->request->getPost('nombreTema'),
               'descripcionTema' => $this->request->getPost('descripcionTema'),
               'pdfTema' => $this->request->getPost('pdfTema'),
           ];
       
           // Instanciar el modelo y insertar el tema
           $temaModel = new TemaModel();
           $temaModel->insert($data);
           $idTema = $temaModel->insertID(); // Obtener el ID del tema recién insertado
       
           // Preparar la respuesta JSON con el ID del tema
           $response = [
               'idTema' => $idTema,
               'nombreTema' => $data['nombreTema'], // Utiliza el nombre del tema del array $data
               'descripcionTema' => $data['descripcionTema'], // Utiliza la descripción del tema del array $data
               'pdfTema' => $data['pdfTema'], // Utiliza el PDF del tema del array $data
               // Puedes incluir más datos aquí si es necesario
           ];
       
           // Devolver la respuesta JSON
           return $this->response->setJSON($response);
       }

      //INSERT DEL TEMARIO POR AJAX
       public function editarTema()
      {
        $idTema=$this->request->getPost('idTema');
          // Obtener los datos del formulario
          $data = [
            'nombreTema' => $this->request->getPost('nombreTema'),
            'descripcionTema' => $this->request->getPost('descripcionTema'),
            'pdfTema' => $this->request->getPost('pdfTema'),
          ];
        //instanciar
        $temaModel= new temaModel();
        $temaModel->update($idTema,$data);
      }

            //INSERT DEL TEMARIO POR AJAX
      public function eliminarTema()
      {
        $idTema=$this->request->getPost('idTema');

          $temaModel = new TemaModel();
          $temaModel->delete($idTema);

      }

      //CARGAR PREGUNTAS 
      public function cargarPreguntas($idMateria)
      {
        // Crear una instancia del modelo de pregunta
        $preguntaModel = new PreguntaModel();

       
        // Ejecutar la consulta utilizando el Query Builder de CodeIgniter
        $preguntas = $preguntaModel
            ->select('pregunta.resolucionPdf,pregunta.idPregunta, pregunta.enunciado, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema, tema.nombreTema')
            ->join('tema', 'pregunta.idTema = tema.idTema')
            ->join('materia_pregunta ', 'pregunta.idPregunta = materia_pregunta.idPregunta','left')
            ->where('pregunta.fecha_elimina', null) // Agregar esta condición
            ->where('materia_pregunta.idMateria IS NULL OR materia_pregunta.idMateria !='.$idMateria) // Agregar esta condición
            ->get()
            ->getResultArray();
      
          // Devolver los temas como JSON
          return json_encode($preguntas);
      }
       //INSERT DE PREGUNTAS POR AJAX
       public function crearPregunta()
       {
           // Obtener los datos del formulario
           $data = [
               'enunciado' => $this->request->getPost('enunciado'),
               'resolucionPdf' => $this->request->getPost('resolucionPdf'),
               'imagenPregunta' => $this->request->getPost('imagenPregunta'),
               'a' => $this->request->getPost('a'),
               'b' => $this->request->getPost('b'),
               'c' => $this->request->getPost('c'),
               'd' => $this->request->getPost('d'),
               'e' => $this->request->getPost('e'),
               'respuesta' =>$this->request->getPost('respuesta'),
               'idTema' => $this->request->getPost('idTema'),
               'exPas' => $this->request->getPost('exPas'),
               'dificultad' => $this->request->getPost('dificultad'),
           ];
       
           // Instanciar el modelo y insertar el tema
           $preguntaModel = new PreguntaModel();
           $preguntaModel->insert($data);
           $idPregunta = $preguntaModel->insertID(); // Obtener el ID del tema recién insertado
       
           // Preparar la respuesta JSON con el ID del tema
           $response = [
               'idPregunta' => $idPregunta,
               'enunciado' => $data['enunciado'], // Utiliza el nombre del tema del array $data
           ];
       
           // Devolver la respuesta JSON
           return $this->response->setJSON($response);
       }
       public function editarPregunta()
       {
        $idPregunta=$this->request->getPost('idPregunta');
           // Obtener los datos del formulario
           $data = [
               'enunciado' => $this->request->getPost('enunciado'),
               'resolucionPdf' => $this->request->getPost('resolucionPdf'),
               'imagenPregunta' => $this->request->getPost('imagenPregunta'),
               'a' => $this->request->getPost('a'),
               'b' => $this->request->getPost('b'),
               'c' => $this->request->getPost('c'),
               'd' => $this->request->getPost('d'),
               'e' => $this->request->getPost('e'),
               'respuesta' =>$this->request->getPost('respuesta'),
               'idTema' => $this->request->getPost('idTema'),
               'exPas' => $this->request->getPost('exPas'),
               'dificultad' => $this->request->getPost('dificultad'),
           ];
       
           // Instanciar el modelo y insertar el tema
           $preguntaModel = new PreguntaModel();
           $preguntaModel->update($idPregunta,$data);
           $idPregunta = $preguntaModel->insertID(); // Obtener el ID del tema recién insertado
       
           // Preparar la respuesta JSON con el ID del tema
           $response = [
               'idPregunta' => $idPregunta,
               'enunciado' => $data['enunciado'], // Utiliza el nombre del tema del array $data
           ];
       
           // Devolver la respuesta JSON
           return $this->response->setJSON($response);
       }

       public function eliminarPregunta()
       {
          $idPregunta=$this->request->getPost('idPregunta');
          $preguntaModel = new PreguntaModel();
          $preguntaModel->delete($idPregunta);
       }

       //CREACION DE BANCO DE PREGUNTAS 
       public function BancoPreguntasMateria($idMateria)
       {
      
        // Crear una instancia del modelo de pregunta
        $preguntaModel = new PreguntaModel();
        // Ejecutar la consulta utilizando el Query Builder de CodeIgniter
        $preguntas = $preguntaModel
            ->select('tema.nombreTema,pregunta.idTema,materia_pregunta.idMateria,pregunta.idPregunta, pregunta.enunciado, pregunta.resolucionPdf, pregunta.imagenPregunta, pregunta.a, pregunta.b,pregunta.c,pregunta.d,pregunta.e,pregunta.respuesta,pregunta.exPas,pregunta.dificultad')
            ->join('materia_pregunta', 'pregunta.idPregunta=materia_pregunta.idPregunta')
            ->join('tema', 'pregunta.idTema=tema.idTema')
            ->where('materia_pregunta.idMateria', $idMateria) // Agregar esta condición
            ->get()
            ->getResultArray();       
          // Devolver las preguntas como JSON
          return json_encode($preguntas);
       }

       public function insertBancoPregunta()
       {
          $idPregunta=$this->request->getPost('idPregunta');
          $idMateria=$this->request->getPost('idMateria');

          $materiaPreguntaModel = new MateriaPreguntaModel();
          $insertar = $materiaPreguntaModel->insertarRelacionMateriaPregunta($idMateria, $idPregunta);

          if ($insertar) {
              echo 'La relación se inserto correctamente.';
          } else {
              echo 'La relación se inserto correctamente.';
          }
       }
       public function deleteBancoPregunta()
       {
          $idPregunta=$this->request->getPost('idPregunta');
          $idMateria=$this->request->getPost('idMateria');

          $materiaPreguntaModel = new MateriaPreguntaModel();
          $eliminado = $materiaPreguntaModel->eliminarRelacionMateriaPregunta($idMateria, $idPregunta);

          if ($eliminado) {
              echo 'La relación se eliminó correctamente.';
          } else {
              echo 'La relación se eliminó correctamente.';
          }
       }
}