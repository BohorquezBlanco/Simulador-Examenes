<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//###############################-USUARIO RUTAS-#################################

$routes->get('/', 'Usuario\ControleUser::index');
//Contenido
$routes->get('/material', 'Usuario\ControleUser::material');
$routes->get('/examen', 'Usuario\ControleUser::examen');
$routes->get('/comunidad', 'Usuario\ControleUser::comunidad');
//sesion
$routes->get('/iniciarSesion', 'Usuario\ControleUser::iniciarsesion');
$routes->post('/login', 'Usuario\ControleUser::login');
$routes->get('/logout', 'Usuario\ControleUser::logout');

$routes->get('/examenGE/(:num)', 'Usuario\ControleUser::examenGE/$1');

//temarios

$routes->post('/temarioLibro', 'Usuario\ControleUser::login');


/*Ver si sirven */
$routes->get('/bibliografia/(:num)', 'Usuario\ControleUser::bibliografia/$1');
$routes->get('/examenes/(:num)/(:num)', 'Usuario\ControleUser::examenes/$1/$2');
$routes->get('/resolverExamen/(:num)/(:any)', 'Usuario\ControleUser::resolverExamen/$1/$2');
$routes->get('/finalizacion/examen', 'Usuario\ControleUser::finalizacion');
$routes->post('/examenResultado', 'Usuario\ControleUser::examenResultado'); //aqui muestra la calificacion del examen 
$routes->post('/revisarExamen', 'Usuario\ControleUser::revisarExamen'); //aqui muestra el examen y las respuestas dadas :D



//###############################-ADMINISTRADOR RUTAS-#################################
$routes->get('/inicioAdmi', 'Admi\ControleAdmi::index');

$routes->post('/uniAjax', 'Admi\ControleAdmi::universidadAjax');
$routes->post('/eliminarUni', 'Admi\ControleAdmi::eliminarUni');
$routes->post('/editarUni', 'Admi\ControleAdmi::editarUni');
$routes->post('/crearUni', 'Admi\ControleAdmi::crearUni');

$routes->post('/carreraAjax', 'Admi\ControleAdmi::carreraAjax');
$routes->post('/allCarreras', 'Admi\ControleAdmi::allCarreras');

$routes->post('/eliminarCarrera', 'Admi\ControleAdmi::eliminarCarrera');
$routes->post('/editarCarrera', 'Admi\ControleAdmi::editarCarrera');
$routes->post('/crearCarrera', 'Admi\ControleAdmi::crearCarrera');

$routes->post('/materiaAjax', 'Admi\ControleAdmi::materiaAjax');
$routes->post('/eliminarMateria', 'Admi\ControleAdmi::eliminarMateria');
$routes->post('/editarMateria', 'Admi\ControleAdmi::editarMateria');
$routes->post('/crearMateria', 'Admi\ControleAdmi::crearMateria');

$routes->post('/temarioMateria', 'Admi\ControleAdmi::temarioMateria');
$routes->post('/eliminarTemario', 'Admi\ControleAdmi::eliminarMateria');
$routes->post('/modificarTemario', 'Admi\ControleAdmi::modificarTemario');
$routes->post('/crearTemario', 'Admi\ControleAdmi::crearTemario');

$routes->post('/temaCarrera', 'Admi\ControleAdmi::temaCarrera');

$routes->post('/preguntasAjax', 'Admi\ControleAdmi::preguntasAjax');
$routes->post('/crearPregunta', 'Admi\ControleAdmi::crearPregunta');
$routes->post('/modificarPregunta', 'Admi\ControleAdmi::modificarPregunta');
$routes->post('/eliminarPregunta', 'Admi\ControleAdmi::eliminarPregunta');
$routes->post('/areaTemaP', 'Admi\ControleAdmi::areaTemaP');

$routes->post('/temaTemario', 'Admi\ControleAdmi::temaTemario');
$routes->post('/eliminarTema', 'Admi\ControleAdmi::eliminarTema');
$routes->post('/modificarTema', 'Admi\ControleAdmi::modificarTema');
$routes->post('/crearTema', 'Admi\ControleAdmi::crearTema');
$routes->post('/agregarTema', 'Admi\ControleAdmi::agregarTema');

//ADMINISTRADOR EXAMEN
$routes->post('/crearExamen', 'Admi\ControleAdmi::crearExamen');
$routes->post('/editarExamen', 'Admi\ControleAdmi::editarExamen');
$routes->post('/eliminarExamen', 'Admi\ControleAdmi::eliminarExamen');

//ADMINISTRADOR CERRAR SESIÓN
$routes->post('/logout', 'Admi\ControleAdmi::logout');


$routes->post('/allTemas', 'Admi\ControleAdmi::allTemas');
$routes->post('/temaCarreraHuerfanos', 'Admi\ControleAdmi::temaCarreraHuerfanos');
$routes->post('/areaTema', 'Admi\ControleAdmi::areaTema');


//Relacion de temaTemario
$routes->post('/eliminarTemaTemario', 'Admi\ControleAdmi::eliminarTemaTemario');
$routes->post('/agregarTemaTemario', 'Admi\ControleAdmi::agregarTemaTemario');


//RUTA DE ENCRIPTACION PARA BASE DE DATOS
$routes->get('/pas/(:segment)/(:segment)', 'Admi\ControleAdmi::pas/$1/$2');


//USUARIO
$routes->post('/userAjax', 'Admi\ControleAdmi::editarUser');