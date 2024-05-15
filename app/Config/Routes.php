<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//###############################-POR DEFECTO-#################################
//1)INICIAR SESION DE LA PAGINA Y LOGOUT
$routes->get('/', 'Usuario\ControleUser::index');

$routes->get('/iniciarSesion', 'Usuario\ControleUser::iniciarsesion');
$routes->post('/login', 'Usuario\ControleUser::login');
$routes->get('/logout', 'Usuario\ControleUser::logout');

//contenido de carreras y demas 
$routes->get('/contenido', 'Usuario\ControleContenido::index');

//###############################-USUARIO RUTAS-#################################
//2)INICIO DE USUARIO
$routes->get('/inicio', 'Usuario\ControleUser::inicio');
$routes->get('/carreras', 'Usuario\ControleUser::carreras');
$routes->get('/materias/(:num)', 'Usuario\ControleUser::materia/$1');

//3)SELECT BIBLIOGRAFIA
$routes->get('/bibliografia/(:num)', 'Usuario\ControleUser::bibliografia/$1');

//3)EXAMEN
$routes->get('/examenes/(:num)/(:num)', 'Usuario\ControleUser::examenes/$1/$2');
$routes->get('/resolverExamen/(:num)/(:any)', 'Usuario\ControleUser::resolverExamen/$1/$2');
$routes->get('/finalizacion/examen', 'Usuario\ControleUser::finalizacion');
$routes->post('/examenResultado', 'Usuario\ControleUser::examenResultado'); //aqui muestra la calificacion del examen 
$routes->post('/revisarExamen', 'Usuario\ControleUser::revisarExamen'); //aqui muestra el examen y las respuestas dadas :D






//###############################-ADMINISTRADOR RUTAS-#################################
$routes->get('/inicioAdmi', 'Admi\ControleAdmi::index');
$routes->get('/comida', 'Admi\ControleAdmi::comida');

//ADMINISTRADOR UNIVINST
$routes->post('/crearUni', 'Admi\ControleAdmi::crearUni');
$routes->post('/eliminarUni', 'Admi\ControleAdmi::eliminarUni');
$routes->post('/editarUni', 'Admi\ControleAdmi::editarUni');

//ADMINISTRADOR CARRERA 
$routes->post('/crearCarrera', 'Admi\ControleAdmi::crearCarrera');
$routes->post('/eliminarCarrera', 'Admi\ControleAdmi::eliminarCarrera');
$routes->post('/editarCarrera', 'Admi\ControleAdmi::editarCarrera');

//ADMINISTRADOR MATERIA
$routes->post('/crearMateria', 'Admi\ControleAdmi::crearMateria');
$routes->post('/eliminarMateria', 'Admi\ControleAdmi::eliminarMateria');
$routes->post('/editarMateria', 'Admi\ControleAdmi::editarMateria');

//ADMINISTRADOR LIBRO
$routes->post('/crearLibro', 'Admi\ControleAdmi::crearLibro');
$routes->post('/eliminarLibro', 'Admi\ControleAdmi::eliminarLibro');
$routes->post('/editarLibro', 'Admi\ControleAdmi::editarLibro');

//ADMINISTRADOR TEMARIO
$routes->post('/crearTemario', 'Admi\ControleAdmi::crearTemario');
$routes->post('/editarTemario', 'Admi\ControleAdmi::editarTemario');
$routes->post('/eliminarTemario', 'Admi\ControleAdmi::eliminarTemario');

//ADMINISTRADOR PREGUNTAS
$routes->post('/crearPregunta', 'Admi\ControleAdmi::crearPregunta');
$routes->post('/editarPregunta', 'Admi\ControleAdmi::editarPregunta');
$routes->post('/eliminarPregunta', 'Admi\ControleAdmi::eliminarPregunta');

//ADMINISTRADOR EXAMEN
$routes->post('/crearExamen', 'Admi\ControleAdmi::crearExamen');
$routes->post('/editarExamen', 'Admi\ControleAdmi::editarExamen');
$routes->post('/eliminarExamen', 'Admi\ControleAdmi::eliminarExamen');



//ADMINISTRADOR CERRAR SESIÓN
$routes->post('/logout', 'Admi\ControleAdmi::logout');
$routes->get('/comida', 'Admi\ControleAdmi::comida');


$routes->post('/uniAjax', 'Admi\ControleAdmi::univercidadAjax');
$routes->post('/eliminarUni2', 'Admi\ControleAdmi::eliminarUni2');
$routes->post('/editarUni2', 'Admi\ControleAdmi::editarUni2');
$routes->post('/crearUni2', 'Admi\ControleAdmi::crearUni2');

$routes->post('/carreraAjax', 'Admi\ControleAdmi::carreraAjax');
$routes->post('/eliminarCarrera2', 'Admi\ControleAdmi::eliminarCarrera2');
$routes->post('/editarCarrera2', 'Admi\ControleAdmi::editarCarrera2');
$routes->post('/crearCarrera2', 'Admi\ControleAdmi::crearCarrera2');

$routes->post('/materiaAjax', 'Admi\ControleAdmi::materiaAjax');
$routes->post('/eliminarMateria2', 'Admi\ControleAdmi::eliminarMateria2');
$routes->post('/editarMateria2', 'Admi\ControleAdmi::editarMateria2');
$routes->post('/crearMateria2', 'Admi\ControleAdmi::crearMateria2');

$routes->post('/temarioMateria', 'Admi\ControleAdmi::temarioMateria');
$routes->post('/eliminarTemario', 'Admi\ControleAdmi::eliminarMateria2');
$routes->post('/modificarTemario', 'Admi\ControleAdmi::modificarTemario');
$routes->post('/crearTemario', 'Admi\ControleAdmi::crearTemario');



