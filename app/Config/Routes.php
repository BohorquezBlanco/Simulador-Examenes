<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


//###############################-USUARIO RUTAS-#################################
    //1)INICIAR CESION DE LA PAGINA Y LOGOUT
    $routes->get('/iniciarSesion', 'Usuario\ControleUser::iniciarsesion');
    $routes->post('/login', 'Usuario\ControleUser::loginIngresar');
    $routes->get('/logout', 'Usuario\ControleUser::logout');
    $routes->get('/', 'Usuario\ControleUser::index');


    //2)INICIO DE USUARIO
    $routes->get('/inicio', 'Usuario\ControleUser::inicio');
    $routes->get('/carreras', 'Usuario\ControleUser::carreras');
    $routes->get('/materias/(:num)', 'Usuario\ControleUser::materia/$1');

    //3)SELECT BIBLIOGRAFIA
    $routes->get('/bibliografia/(:num)', 'Usuario\ControleUser::bibliografia/$1');

    //3)EXAMEN
    $routes->get('/examenes/(:num)/(:num)/(:segment)', 'Usuario\ControleUser::examenes/$1/$2/$3');
    $routes->get('/resolverPregunta/(:num)/(:num)/(:num)', 'Usuario\ControleUser::resolverPregunta/$1/$2/$3');
    $routes->get('/ResolverExamen/(:num)/(:num)/(:num)', 'Usuario\ControleUser::ResolverExamen/$1/$2/$3');
    $routes->post('/ExamenPersonalizado', 'Usuario\ControleUser::ExamenPersonalizado');
    $routes->get('/resolverExamenCarrera/(:num)', 'Usuario\ControleUser::resolverExamenCarrera/$1');

    //###############################-ADMINISTRADOR RUTAS-#################################
    $routes->get('/inicioAdmi', 'Admi\ControleAdmi::index');

    //ADMINISTRADOR CARRERA 
        //SELECT  
        $routes->get('/carrerasAdmi', 'Admi\ControleAdmi::carreras');
        //INSERT 
        $routes->post('/crearCarrera', 'Admi\ControleAdmi::crearCarrera');
        //DELETE LOGICO 
        $routes->post('/eliminarCarrera', 'Admi\ControleAdmi::eliminarCarrera');
        //EDITAR 
        $routes->post('/editarCarrera', 'Admi\ControleAdmi::editarCarrera');


    //ADMINISTRADOR MATERIA
        //SELECT  
        $routes->get('/materiasAdmi/(:num)', 'Admi\ControleAdmi::materia/$1');
        //INSERT 
        $routes->post('/crearMateria', 'Admi\ControleAdmi::crearMateria');
        //DELETE LOGICO 
        $routes->post('/eliminarMateria', 'Admi\ControleAdmi::eliminarMateria');
        //UPDATE 
        $routes->post('/editarMateria', 'Admi\ControleAdmi::editarMateria');


    //ADMINISTRADOR TEMAS PREGUNTAS Y BANCO DE PREGUNTAS 
        //BITACORA DE TEMAS PREGUNTAS Y BANCO DE PREGUNTAS  
        $routes->get('/reforzarAdmi/(:num)/(:num)/(:segment)', 'Admi\ControleAdmi::bitacorareforzar/$1/$2/$3');
        //CRUD TEMAS 
        $routes->get('/cargarTemas', 'Admi\ControleAdmi::cargarTemas');
        $routes->post('/crearTema', 'Admi\ControleAdmi::crearTema');
        $routes->post('/editarTema', 'Admi\ControleAdmi::editarTema');
        $routes->post('/eliminarTema', 'Admi\ControleAdmi::eliminarTema');
        //CRUD PREGUNTAS 
        $routes->get('/cargarPreguntas/(:num)', 'Admi\ControleAdmi::cargarPreguntas/$1');
        $routes->post('/crearPregunta', 'Admi\ControleAdmi::crearPregunta');
        $routes->post('/editarPregunta', 'Admi\ControleAdmi::editarPregunta');
        $routes->get('/BancoPreguntasMateria/(:num)', 'Admi\ControleAdmi::BancoPreguntasMateria/$1');
        $routes->post('/deleteBancoPregunta', 'Admi\ControleAdmi::deleteBancoPregunta');
        $routes->post('/insertBancoPregunta', 'Admi\ControleAdmi::insertBancoPregunta');


        //ADMINISTRADOR BIBLIOGRAFIA
        //BIBLIOGRAFIA
        $routes->get('/bibliografiaAdm/(:num)', 'Admi\ControleAdmi::bibliografia/$1');

        //INSERT
        $routes->post('/crearLibro', 'Admi\ControleAdmi::crearLibro');
        //DELETE LOGICO 
        $routes->post('/eliminarLibro', 'Admi\ControleAdmi::eliminarLibro');
        //UPDATE 
        $routes->post('/editarLibro', 'Admi\ControleAdmi::editarLibro');

        $routes->post('/guardarLibro', 'Admi\ControleAdmi::guardarLibro');
    
