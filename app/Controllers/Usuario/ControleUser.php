<?php

namespace App\Controllers\Usuario;
use App\Controllers\BaseController;

use App\Models\PreguntaModel;
use App\Models\CarreraModel;
use App\Models\MateriaModel;
use App\Models\ExamenModel;
use App\Models\LibroModel;
use App\Models\TemaModel;

class ControleUser extends BaseController
{
    //INICIO DEL SISTEMA
    public function index()
    {
        $session = session(); // Accede al servicio de sesiones
        $idseccion = $session->get('tipo');
        if ($idseccion == 1) {  
            $carreraModel= new CarreraModel();
            $carreras=$carreraModel->findAll();
            $data=['carreras'=>$carreras];
            return view('header/1header').
                    view('barraNavegacion/barra1').
                    view('user/1inicio').
                    view('footer/1footer');        
        }
        else  {
            if($idseccion == 2)
            {
                return redirect()->to(base_url().'/inicioAdmi');
            }
            else{
                $carreraModel= new CarreraModel();
                $carreras=$carreraModel->findAll();
                $data=['carreras'=>$carreras];
                return view('header/1header').
                        view('barraNavegacion/barra1').
                        view('user/1inicio').
                        view('footer/1footer');   
            }
        }

    
    }

    //INICIAR SESION
    public function iniciarSesion()
    {
        return view('header/1header').
                view('barraNavegacion/barra1').
                view('user/login');
    }

    //FUNCION PARA LOGEARSE
    public function loginIngresar()
    {
        // Validar campos de entrada
        $rules = [
            'correo' => 'required',
            'password' => 'required'
        ];
        if (!$this->validate($rules)) {
            // Si la validación falla, redirige de vuelta con errores y datos de entrada
            return redirect()->back()->with('errors', $this->validator->getErrors())->withInput();
        }

        // Obtener datos del formulario
        $correo = $this->request->getVar('correo');
        $password = $this->request->getVar('password');

        // Obtener el modelo de usuario
        $usuariomodel = model('UsuarioModel');

        // Buscar el usuario por el nombre de usuario (correo de usuario)
        $user = $usuariomodel->getUserBy('correo', $correo);
        if (!$user) {
            // Si el usuario no existe, mostrar mensaje de error y redirigir de vuelta
            return redirect()->back()->with('msg', [
                'type' => 'danger',
                'body' => 'Este usuario no se encuentra registrado en el sistema'
            ]);
        }

        // Verificar la contraseña
        if ($password !== $user->password) {
            // Si la contraseña es incorrecta, mostrar mensaje de error y redirigir de vuelta
            return redirect()->back()->with('msg', [
                'type' => 'danger',
                'body' => 'Credenciales inválidas'
            ]);
        }

        // Iniciar sesión
        session()->set([
            'idUsuario' => $user->idUsuario,
            'correo' => $user->correo,
            'tipo' => $user->tipo,
            'is_logged' => true
        ]);

        // Redirigir al usuario a la página de inicio
        return redirect()->to('/')->with('msg', [
            'type' => 'success',
            'body' => 'Bienvenido, ' . $user->correo
        ]);
    }

    //FUNCION PARA CERRAR SESION
    public function logout()
    {
        // Eliminar todos los datos de la sesión
        session()->destroy();
    
        // Redirigir al usuario a la página de inicio de sesión o a cualquier otra página deseada
        return redirect()->to('/')->with('msg', [
            'type' => 'success',
            'body' => 'Has cerrado sesión exitosamente'
        ]);
    }


    //SELECT DE LOS CARRERAS EXISTENTES
    public function carreras()
    {
        //con esto se podra ver todas las materias que se tienen
        $carreraModel= new CarreraModel();
        $carreras=$carreraModel->findAll();

        $data=['carreras'=>$carreras,'titulo'=>"Nuestras Carreras "];
        return view('header/1header',$data).
                view('barraNavegacion/barra1').
                view('user/2carreras').
                view('footer/1footer');
    }

    //SELECT DE LAS MATERIAS EXISTENTES DEL CURSO
    public function materia($idCarrera)
    {
        $materiaModel= new MateriaModel();
        $carreras = $materiaModel->where('idCarrera', $idCarrera)->findAll();


        //nombre del titulo
        $carreraModel= new CarreraModel();
        $titulo=$carreraModel->find($idCarrera);

        $data=['carreras'=>$carreras,'titulo'=>$titulo];
        return view('header/1header',$data).
                view('barraNavegacion/barra1').
                view('user/3materia').
                view('footer/1footer');

    }

    //MOSTRAR EL BANCO DE EXAMENES Y LOS 2 TIPOS DE EXAMENES QUE PUEDE REALIZAR
    public function examenes($idCarrera,$idMateria,$nombre)
    {
        $temaModel = new TemaModel();
        $temas = $temaModel
            ->select('tema.nombreTema, tema.idTema')
            ->join('pregunta', 'tema.idTema = pregunta.idTema')
            ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta')
            ->where('materia_pregunta.idMateria', $idMateria)
            ->where('pregunta.fecha_elimina IS NULL')
            ->groupBy('tema.idTema') // Agrupar por idTema
            ->findAll();

            // Crear una instancia del modelo de pregunta
             $preguntaModel = new PreguntaModel();
              // Ejecutar la consulta utilizando el Query Builder de CodeIgniter
             $preguntas = $preguntaModel
             ->select('pregunta.idPregunta, pregunta.enunciado, pregunta.resolucionPdf, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema, materia_pregunta.idMateria, pregunta.fecha_elimina')
              ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta')
              ->where('pregunta.fecha_elimina IS NULL')
              ->where('materia_pregunta.idMateria', $idMateria)
              ->findAll();

        $data=['nombre'=>$nombre,'idMateria'=>$idMateria,'preguntas'=>$preguntas,'idCarrera'=>$idCarrera,'temas'=>$temas];
        return view('header/1header').
        view('barraNavegacion/barra1').
        view('user/5bitacoraReforzar',$data). 
        view('footer/1footer');  

    }


    //resolucion de una pregunta del banco de preguntas
    public function resolverPregunta($idPregunta,$idCarrera,$idMateria)
    {
        $tiempo='SL';
        $cantidad=1;

        $materiaModel= new MateriaModel();
        $materias= $materiaModel->where('idCarrera', $idCarrera)->findAll();

        $datosMaterias = $materiaModel->select('materia.*, carrera.nombreCarrera')
            ->join('carrera', 'materia.idCarrera = carrera.idCarrera', 'left')
            ->where('materia.idMateria', $idMateria)
            ->first();


            $preguntaModel = new PreguntaModel();
            $preguntas = $preguntaModel
            ->select('materia.nombreMateria,pregunta.resolucionPdf,pregunta.idPregunta, pregunta.enunciado, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema, materia_pregunta.idMateria, pregunta.fecha_elimina')
            ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta')
            ->join('materia', 'materia_pregunta.idMateria = materia.idMateria')
            ->where('pregunta.fecha_elimina IS NULL')
            ->where('materia_pregunta.idPregunta', $idPregunta)
          
            ->limit(1)
            ->find();

        $data=['preguntas'=>$preguntas,'materias'=>$materias,'datosMaterias'=>$datosMaterias,'tiempo'=>$tiempo,'cantidad'=>$cantidad];
        return view('header/1header').
        view('barraNavegacion/barra2').
        view('user/6Examen',$data).
        view('footer/1footer');  
    }

    public function resolverExamen($idMateria,$idCarrera,$Tipo)
    {
        $tiempo='SL';
        $cantidad=10;
        $materiaModel= new MateriaModel();
        $materias= $materiaModel->where('idCarrera', $idCarrera)->findAll();

        $materiaModel = new MateriaModel();
        $datosMaterias = $materiaModel->select('materia.*, carrera.nombreCarrera')
            ->join('carrera', 'materia.idCarrera = carrera.idCarrera', 'left')
            ->where('materia.idMateria', $idMateria)
            ->first();

         if ($Tipo==0) {
            // Cargar el modelo de pregunta
            $preguntaModel = new PreguntaModel();
            $preguntas = $preguntaModel
            ->select('materia.nombreMateria,pregunta.resolucionPdf,pregunta.idPregunta, pregunta.enunciado, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema, materia_pregunta.idMateria, pregunta.fecha_elimina')
            ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta')
            ->join('materia', 'materia_pregunta.idMateria = materia.idMateria')
            ->where('pregunta.fecha_elimina IS NULL')
            ->where('materia_pregunta.idMateria', $idMateria)
            ->orderBy('RAND()')
            ->limit(10)
            ->find();
            
              $data=['preguntas'=>$preguntas,'materias'=>$materias,'datosMaterias'=>$datosMaterias,'tiempo'=>$tiempo,'cantidad'=>$cantidad];
              return view('header/1header').
              view('barraNavegacion/barra1').
              view('user/6Examen',$data).
              view('footer/1footer');  
         }
         else{

            echo "ERROR DE DATOS ENVIADOS >:l";
            
         }
   
    }

    public function resolverExamenCarrera($idCarrera)
    {
        $tiempo='SL';
        $cantidad=10;
        $materiaModel= new MateriaModel();
        $materias= $materiaModel->where('idCarrera', $idCarrera)->findAll();

            $carreraModel = new CarreraModel();
            $datosMaterias = $carreraModel->select('carrera.*')
            ->where('carrera.idCarrera', $idCarrera)
            ->first();

            $materiaModel = new MateriaModel();
            $preguntas = $materiaModel
                ->select('materia.idMateria,materia.nombreMateria, pregunta_principal.idPregunta,pregunta_principal.respuesta, pregunta_principal.resolucionPdf, pregunta_principal.a, pregunta_principal.b, pregunta_principal.c, pregunta_principal.d, pregunta_principal.e,pregunta_principal.enunciado,pregunta_principal.imagenPregunta, pregunta_principal.fecha_elimina')
                ->join('('
                    . 'SELECT mp.idMateria, mp.idPregunta, ROW_NUMBER() OVER (PARTITION BY mp.idMateria ORDER BY RAND()) AS row_num '
                    . 'FROM materia_pregunta mp'
                    . ') AS subconsulta', 'subconsulta.idMateria = materia.idMateria')
                ->join('pregunta pregunta_principal', 'subconsulta.idPregunta = pregunta_principal.idPregunta')
                ->where('subconsulta.row_num <=', 10)
                ->where('materia.idCarrera', $idCarrera)
                ->orderBy('materia.idMateria, pregunta_principal.idPregunta')
                ->find();
            
      
              $data=['preguntas'=>$preguntas,'materias'=>$materias,'datosMaterias'=>$datosMaterias,'tiempo'=>$tiempo,'cantidad'=>$cantidad];
              return view('header/1header').
              view('barraNavegacion/barra1').
              view('user/6Examen',$data).
              view('footer/1footer');  
    }

    //MOSTRAR EL RESULTADO DE UN EXAMEN ALEATORIO
    public function examenResultado()
    {
        
        $nombreCarrera= $this->request->getPost('nombreCarrera');

        $respuestas = $this->request->getPost('respuestas');

        $nombreMateria=$this->request->getPost('materia');

     
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['respuestasSeleccionadas'])) {
            // Recupera las respuestas seleccionadas del formulario
            $respuestasSeleccionadas = $_POST['respuestasSeleccionadas'];
            
            // Inicializa variables para contar respuestas correctas e incorrectas
            $respuestasCorrectas = 0;
            $respuestasIncorrectas = 0;
        
            // Calcula el puntaje
            $puntaje = 0;
            foreach ($respuestasSeleccionadas as $indice => $respuestaSeleccionada) {
                // Verifica si la respuesta seleccionada es igual a la respuesta correcta
                if ($respuestaSeleccionada === $respuestas[$indice]) {
                    $respuestasCorrectas++; // Incrementa el contador de respuestas correctas
                    $puntaje++; // Incrementa el puntaje si la respuesta es correcta
                } else {
                    $respuestasIncorrectas++; // Incrementa el contador de respuestas incorrectas
                }
            }
            
            // Calcula el puntaje total
            $totalPreguntas = count($respuestas);
            $puntajeTotal = ($puntaje / $totalPreguntas) * 100;
        
            // Imprime el puntaje total, respuestas correctas e incorrectas
            echo "Puntaje total: " . $puntajeTotal . "%<br>";
            echo "Respuestas correctas: " . $respuestasCorrectas . "<br>";
            echo "Respuestas incorrectas: " . $respuestasIncorrectas . "<br>";
        } else {
            echo "No se han recibido respuestas seleccionadas.";
        }
        

        //$data=['resultados'=>$resultados,'seleccion'=>$seleccion,'calificacion'=>$calificacion,'respuestas'=>$respuestas,'codigoExamen'=>$codigoExamen,'idCarrera'=>$idCarrera,'nombreCarrera'=>$nombreCarrera];
      
        //return view('header/1header').
        //view('barraNavegacion/barra2').
        //view('user/examenResultado');
        
      
    }

    //MOSTRAR EL EXAMEN DADO COMPARADO CON LAS RESPUESTAS DADAS POR EL PRACTICANTE
    public function revisarExamen()
    {
        
        $idCarrera= $this->request->getPost('idCarrera');
        $codigo= $this->request->getPost('codigoExamen');
        $seleccion=$this->request->getPost('seleccion');
        $resultados=$this->request->getPost('resultados');

        //carrera
        $carreraModel= new CarreraModel();
        $carreras=$carreraModel->findAll();

        $nombreCarrera = $carreraModel->where('idCarrera', $idCarrera)->first();
        $nombreCarrera=$nombreCarrera['nombreCarrera'];

        $materiaModel= new MateriaModel();
        $materias = $materiaModel->where('idcarrera', $idCarrera)->findAll();
  
      
        //preguntas que tiene el examen 
        $examenModel= new examenModel();
        $examenPregunta = $examenModel
        ->select('examen.puntaje, materia.nombreMateria, materia.descripcionMateria, examen.idExamen, examen.idMateria, examen.gestionExamen, examen.añoExamen, examen.opcionExamen, examen.codigoExamen, pregunta.enunciado, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.formula, pregunta.idPregunta, pregunta.respuesta, tema.nombreTema')
        ->join('pregunta_examen', 'examen.idExamen = pregunta_examen.idExamen')
        ->join('pregunta', 'pregunta_examen.idPregunta = pregunta.idPregunta')
        ->join('tema', 'pregunta.idTema = tema.idTema')
        ->join('materia', 'examen.idMateria = materia.idMateria')
        ->where('examen.codigoExamen', $codigo)
      
        ->findAll();

                //preguntas que tiene el examen 
                $examenModel= new examenModel();
                $materias = $examenModel
                ->select('examen.puntaje, materia.nombreMateria, materia.descripcionMateria, examen.idExamen, examen.idMateria, examen.gestionExamen, examen.añoExamen, examen.opcionExamen, examen.codigoExamen, pregunta.enunciado, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.formula, pregunta.idPregunta, pregunta.respuesta, tema.nombreTema')
                ->join('pregunta_examen', 'examen.idExamen = pregunta_examen.idExamen')
                ->join('pregunta', 'pregunta_examen.idPregunta = pregunta.idPregunta')
                ->join('tema', 'pregunta.idTema = tema.idTema')
                ->join('materia', 'examen.idMateria = materia.idMateria')
                ->where('examen.codigoExamen', $codigo)
                ->groupBy('examen.idMateria')
                ->findAll();
                
        
  
      $data=['resultado' => $resultados,'seleccion' => $seleccion,'nombreCarrera'=>$nombreCarrera,'examenes'=>$examenPregunta,'materias'=>$materias, 'idCarrera'=>$idCarrera,'carreras'=>$carreras];
  
      return view('header/1header').
      view('barraNavegacion/barra2',$data).
      view('user/examenRevision');

        
      
    }

    public function examenPersonalizado() 
    {
        $idCarrera= $this->request->getPost('idCarrera');
        $idMateria= $this->request->getPost('idMateria');
        $temasIncluidos=$this->request->getPost('idTema');
        $tiempo=$this->request->getPost('tiempo');
        $cantidad = intval($this->request->getPost('cantidad'));
        
        if ($tiempo<=0) {
            $tiempo=1;
        }
        if ($cantidad<=0) {
            $cantidad=1;
        }
        
        if (!empty($temasIncluidos)) {
           
            $materiaModel= new MateriaModel();
            $materias= $materiaModel->where('idCarrera', $idCarrera)->findAll();

            $materiaModel = new MateriaModel();
            $datosMaterias = $materiaModel->select('materia.*, carrera.nombreCarrera')
                ->join('carrera', 'materia.idCarrera = carrera.idCarrera', 'left')
                ->where('materia.idMateria', $idMateria)
                ->first();

    
                $preguntaModel = new PreguntaModel();
                $preguntas = $preguntaModel
                ->select('materia.nombreMateria,pregunta.resolucionPdf,pregunta.idPregunta, pregunta.enunciado, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema, materia_pregunta.idMateria, pregunta.fecha_elimina')
                ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta')
                ->join('materia', 'materia_pregunta.idMateria = materia.idMateria')
                ->whereIn('pregunta.idTema', $temasIncluidos)
                ->where('pregunta.fecha_elimina IS NULL')
                ->where('materia_pregunta.idMateria', $idMateria)
                ->orderBy('RAND()')
                ->limit($cantidad)
                ->find();

                $data=['preguntas'=>$preguntas,'materias'=>$materias,'datosMaterias'=>$datosMaterias,'tiempo'=>$tiempo,'cantidad'=>$cantidad];

                return view('header/1header').
                view('barraNavegacion/barra1').
                view('user/6Examen',$data).
                view('footer/1footer');  
        } else {
            $materiaModel= new MateriaModel();
            $materias= $materiaModel->where('idCarrera', $idCarrera)->findAll();

            $materiaModel = new MateriaModel();
            $datosMaterias = $materiaModel->select('materia.*, carrera.nombreCarrera')
                ->join('carrera', 'materia.idCarrera = carrera.idCarrera', 'left')
                ->where('materia.idMateria', $idMateria)
                ->first();

    
                $preguntaModel = new PreguntaModel();
                $preguntas = $preguntaModel
                ->select('materia.nombreMateria,pregunta.resolucionPdf,pregunta.idPregunta, pregunta.enunciado, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema, materia_pregunta.idMateria, pregunta.fecha_elimina')
                ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta')
                ->join('materia', 'materia_pregunta.idMateria = materia.idMateria')
                ->where('pregunta.fecha_elimina IS NULL')
                ->where('materia_pregunta.idMateria', $idMateria)
                ->orderBy('RAND()')
                ->limit($cantidad)
                ->find();

                $data=['preguntas'=>$preguntas,'materias'=>$materias,'datosMaterias'=>$datosMaterias,'tiempo'=>$tiempo,'cantidad'=>$cantidad];

                return view('header/1header').
                view('barraNavegacion/barra1').
                view('user/6Examen',$data).
                view('footer/1footer');  
        }

    }

    //MOSTRAR LA BIBLIOGRAFIA EXISTENTE DE LA MATERIA 
    public function bibliografia($idMateria) {
        $materiaModel = new MateriaModel();
        $titulo=$materiaModel->find($idMateria);

        $libroModel= new LibroModel();
        $result = $libroModel
                  ->select('libro.nombreLibro,libro.descripcionLibro,libro.imagenLibro,urlLibro,ml.idMateria')
                  ->join('materia_libro ml', 'libro.idLibro = ml.idLibro')
                  ->where('ml.idMateria',$idMateria);
                  $libros= $result->findAll();

        $data=['libros'=>$libros,'titulo'=>$titulo];

        return view('header/1header',$data).
                view('barraNavegacion/barra1').
                view('user/4bibliografia').
                view('footer/1footer');
    }









    

}
