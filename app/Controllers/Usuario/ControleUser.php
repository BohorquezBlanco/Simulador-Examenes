<?php

namespace App\Controllers\Usuario;
use App\Controllers\BaseController;

use App\Models\PreguntaModel;
use App\Models\CarreraModel;
use App\Models\MateriaModel;
use App\Models\ExamenModel;
use App\Models\LibroModel;

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




    //MOSTRAR EL RESULTADO DE UN EXAMEN ALEATORIO
    public function examenes($idCarrera,$idMateria,$nombre)
    {
                // Crear una instancia del modelo de pregunta
                $preguntaModel = new PreguntaModel();

       
                // Ejecutar la consulta utilizando el Query Builder de CodeIgniter
                $preguntas = $preguntaModel
                ->select('pregunta.idPregunta, pregunta.enunciado, pregunta.formula, pregunta.imagenPregunta, pregunta.a, pregunta.b, pregunta.c, pregunta.d, pregunta.e, pregunta.respuesta, pregunta.exPas, pregunta.dificultad, pregunta.idTema')
                ->join('materia_pregunta', 'pregunta.idPregunta = materia_pregunta.idPregunta', 'left')
                ->where('pregunta.fecha_elimina', null)
                ->where('(materia_pregunta.idMateria IS NULL OR materia_pregunta.idMateria != ' . $idMateria . ')')
                ->get()
                ->getResultArray();


        $data=['nombre'=>$nombre,'idMateria'=>$idMateria,'preguntas'=>$preguntas];
        return view('header/1header').
        view('barraNavegacion/barra2').
        view('user/4Examenes',$data);  
    }

    //resolucion de una pregunta del banco de preguntas
    public function resolverPregunta($idPregunta)
    {

        // Cargar el modelo de pregunta
        $preguntaModel = new PreguntaModel();
        // Realizar la consulta para obtener las preguntas con el ID específico (por ejemplo, 2)
        $preguntas = $preguntaModel->where('idPregunta', $idPregunta)->findAll();

        $data=['preguntas'=>$preguntas];
        return view('header/1header').
        view('barraNavegacion/barra2').
        view('user/5ExamenPregunta',$data).
        view('footer/1footer');  
    }



    //MOSTRAR EL RESULTADO DE UN EXAMEN ALEATORIO
    public function examenResultado()
    {
        $codigoExamen= $this->request->getPost('codigoExamen');

        $idCarrera= $this->request->getPost('idCarrera');
        $nombreCarrera= $this->request->getPost('nombreCarrera');


        $respuestas = $this->request->getPost('respuestas');
        $puntajes= $this->request->getPost('puntaje');
        $delimitador= $this->request->getPost('delimitador');
        $nombreMateria=$this->request->getPost('materia');

        $calificacion = []; // Inicializa un array vacío
        $seleccion = []; // Inicializa un array vacío
        $resultados= [];

        $cont=0;
        $Total=0;
        $Materias='';
        $Puntaje='';
        for ($p = 0; $p < count($puntajes); $p++) 
        {
 
            //delimitaremos por secciones dadas "Aqui obtenemos 
            for ($d = 0; $d < $delimitador[$p]; $d++) 
            {
            
                $num= strval($cont);

                $seleccionado = $this->request->getPost('seleccionado'.$num);

                    if ($respuestas[$cont]==$seleccionado) 
                    {


                    $puntos=$puntajes[$p]/$delimitador[$p];

                    $Total=$Total+$puntos;
                    $Materias=$nombreMateria[$p];
                    $Puntaje=$puntajes[$p];

                    // Agregar un valor al final del arreglo
                    array_push($seleccion, $seleccionado);
                   
                    array_push($resultados, 'Bien');
                   
                    }
                    else {
                        $Materias=$nombreMateria[$p];
                        $Puntaje=$puntajes[$p];
                        // Agregar un valor al final del arreglo
                        array_push($seleccion, $seleccionado);
                        array_push($resultados, 'Mal');

                    }

                    
                $cont=$cont+1;
            }

       

            $calificaciones = [
                'Materia' => $Materias,
                'Total' => $Total,
                'Puntaje' => $Puntaje,
                // Otras claves y valores según sea necesario
            ];

            $calificacion[] = $calificaciones;

            $Total=0;
        }


        

        $data=['resultados'=>$resultados,'seleccion'=>$seleccion,'calificacion'=>$calificacion,'respuestas'=>$respuestas,'codigoExamen'=>$codigoExamen,'idCarrera'=>$idCarrera,'nombreCarrera'=>$nombreCarrera];
      
        return view('header/1header').
        view('barraNavegacion/barra2',$data).
        view('user/examenResultado');
        
      
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

    //MOSTRAR EL BANCO DE PREGUNTAS 
    public function bancoPreguntas() {
    }







    

}
