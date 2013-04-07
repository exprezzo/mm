<?php
//$APP_URL='http://'.$_SERVER['SERVER_NAME']; 
$DB_CONFIG=array(
	'DB_SERVER'	=>'localhost',
	'DB_NAME'	=>'mm',
	'DB_USER'	=>'root',
	'DB_PASS'	=>''
);

if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','multiblock');
if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','sistema');
if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');

$_LOGIN_REDIRECT_PATH = '/'.DEFAULT_APP.'/'.DEFAULT_CONTROLLER.'/'.DEFAULT_ACTION;
// Configuracion del ssitio
define ("NOMBRE_APL",'Multi Block');
define ("PASS_AES",'mu1894sa3s');

// define ("TEMA",'cobalt');
define ("TEMA",'black-tie');

define ("PATH_MVC",'../mvc/');
//define ("DEFAULT_CONTROLLER",'general');
// CONFIGURA LA RUTA DEL NUCLEO
define ("PATH_NUCLEO",'../mvc_core/');

?>