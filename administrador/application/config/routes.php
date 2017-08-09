<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'sesion';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

#######################################################################
# backend
#######################################################################
// login
$route['backend/login'] = 'sesion/login';
$route['backend/logout'] = 'sesion/logout';
// escritorio
$route['backend/escritorio'] = 'backend/escritorio';
// usuario
$route['backend/usuario'] = 'backend/usuario';
$route['backend/usuario/editar/(:num)'] = 'backend/usuario/editar/$1';
$route['backend/usuario/nuevo'] = 'backend/usuario/nuevo';
$route['backend/usuario/guardar'] = 'backend/usuario/guardar';
// historico
$route['backend/historico'] = 'backend/historico';
$route['backend/historico/all/grupos'] = 'backend/historico/grupos_json';
$route['backend/historico/all/mediciones'] = 'backend/historico/mediciones_json';
$route['backend/historico/all/indicadores'] = 'backend/historico/indicadores_json';
$route['backend/historico/all/data/table'] = 'backend/historico/table_json';
$route['backend/historico/download/excel'] = 'backend/historico/download_excel';
$route['backend/historico/upload/excel'] = 'backend/historico/upload_excel';
//$route['backend/historico/nuevo'] = 'backend/historico/nuevo';
$route['backend/historico/guardar'] = 'backend/historico/guardar';

// coyuntura
$route['backend/coyuntura'] = 'backend/coyuntura';
$route['backend/coyuntura/all/grupos'] = 'backend/coyuntura/grupos_json';
$route['backend/coyuntura/all/mediciones'] = 'backend/coyuntura/mediciones_json';
$route['backend/coyuntura/all/indicadores'] = 'backend/coyuntura/indicadores_json';
$route['backend/coyuntura/all/data/table'] = 'backend/coyuntura/table_json';
$route['backend/coyuntura/download/excel'] = 'backend/coyuntura/download_excel';
$route['backend/coyuntura/upload/excel'] = 'backend/coyuntura/upload_excel';
$route['backend/coyuntura/guardar'] = 'backend/coyuntura/guardar';

// internacional
$route['backend/internacional'] = 'backend/internacional';
$route['backend/internacional/all/gestiones'] = 'backend/internacional/gestiones_json';
$route['backend/internacional/all/data/table'] = 'backend/internacional/table_json';
$route['backend/internacional/download/excel'] = 'backend/internacional/download_excel';
$route['backend/internacional/upload/excel'] = 'backend/internacional/upload_excel';

// backup
$route['backend/backup/export'] = 'backend/backup/export_form';
$route['backend/backup/exportar'] = 'backend/backup/exportar_db';
$route['backend/backup/importar'] = 'backend/backup/importar_db';