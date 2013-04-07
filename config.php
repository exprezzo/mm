<?php
//$APP_URL='http://'.$_SERVER['SERVER_NAME']; 

if (!defined('DEFAULT_APP') ) define('DEFAULT_APP','multiblock');
if (!defined('DEFAULT_CONTROLLER') ) define('DEFAULT_CONTROLLER','general');
if (!defined('DEFAULT_ACTION') ) define('DEFAULT_ACTION','index');
$_LOGIN_REDIRECT_PATH = '/'.DEFAULT_APP.'/'.DEFAULT_CONTROLLER.'/'.DEFAULT_ACTION;

/*
define ("PATH_MVC",'../mvc/');
define ("DEFAULT_CONTROLLER",'general');
// CONFIGURA LA RUTA DEL NUCLEO
define ("PATH_NUCLEO",'../mvc_core/');
*/
?>