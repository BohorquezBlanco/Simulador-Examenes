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



//###############################-ADMINISTRADOR RUTAS-#################################
$routes->get('/inicioAdmi', 'Admi\ControleAdmi::index');
$routes->post('/logout', 'Admi\ControleAdmi::logout');

$routes->post('/uniAjax', 'Admi\ControleAdmi::universidadAjax');
$routes->post('/eliminarUni', 'Admi\ControleAdmi::eliminarUni');
$routes->post('/editarUni', 'Admi\ControleAdmi::editarUni');
$routes->post('/crearUni', 'Admi\ControleAdmi::crearUni');

$routes->post('/carreraAjax', 'Admi\ControleAdmi::carreraAjax');
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

$routes->post('/userAjax', 'Admi\ControleAdmi::editarUser');


//contenido de carreras y demas 
$routes->get('/contenido', 'Usuario\ControleContenido::index');


$routes->post('/uniAjaxC', 'Usuario\ControleUser::universidadAjax');
$routes->post('/carreraAjaxC', 'Usuario\ControleUser::carreraAjax');
$routes->post('/materiaAjaxC', 'Usuario\ControleUser::materiaAjax');
$routes->post('/temarioMateriaC', 'Usuario\ControleUser::temarioMateriaC');
$routes->post('/temarioLibroC', 'Usuario\ControleUser::temarioLibroC');

$routes->post('/temaCarrera', 'Admi\ControleAdmi::temaCarrera');

$routes->post('/preguntasAjax', 'Admi\ControleAdmi::preguntasAjax');
$routes->post('/crearPregunta', 'Admi\ControleAdmi::crearPregunta');
$routes->post('/modificarPregunta', 'Admi\ControleAdmi::modificarPregunta');
$routes->post('/eliminarPregunta', 'Admi\ControleAdmi::eliminarPregunta');

$routes->post('/temaTemario', 'Admi\ControleAdmi::temaTemario');
$routes->post('/eliminarTema', 'Admi\ControleAdmi::eliminarTema');
$routes->post('/modificarTema', 'Admi\ControleAdmi::modificarTema');
$routes->post('/crearTema', 'Admi\ControleAdmi::crearTema');
$routes->post('/agregarTema', 'Admi\ControleAdmi::agregarTema');
$routes->get('/pas', 'Admi\ControleAdmi::pas');



//3)EXAMEN
$routes->get('/examenes/(:num)/(:num)', 'Usuario\ControleUser::examenes/$1/$2');
$routes->get('/resolverExamen/(:num)/(:any)', 'Usuario\ControleUser::resolverExamen/$1/$2');
$routes->get('/finalizacion/examen', 'Usuario\ControleUser::finalizacion');
$routes->post('/examenResultado', 'Usuario\ControleUser::examenResultado'); //aqui muestra la calificacion del examen 
$routes->post('/revisarExamen', 'Usuario\ControleUser::revisarExamen'); //aqui muestra el examen y las respuestas dadas :D




//ADMINISTRADOR EXAMEN
$routes->post('/crearExamen', 'Admi\ControleAdmi::crearExamen');
$routes->post('/editarExamen', 'Admi\ControleAdmi::editarExamen');
$routes->post('/eliminarExamen', 'Admi\ControleAdmi::eliminarExamen');

