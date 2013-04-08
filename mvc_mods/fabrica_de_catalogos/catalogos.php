<?php

require_once '../'.$_PETICION->modulo.'/modelos/catalogo_modelo.php';

include 'crear_catalogo/crear_controlador.php';
include 'crear_catalogo/crear_modelo.php';
include 'crear_catalogo/crear_vistas.php';
include 'crear_catalogo/crear_buscador.php';
include 'crear_catalogo/crear_buscadorjs.php';
include 'crear_catalogo/crear_editor.php';
include 'crear_catalogo/crear_editorjs.php';


class catalogos extends Controlador{
	var $modelo="Catalogo";
	
	function nuevo(){		
		$obj=array(
			'id'=>0,
			'nombre'=>'Nombre',
			'controlador'=>'Controlador',
			'modelo'=>'Modelo',
			'tabla'=>'Tabla'
		);
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function crear_catalogo($controlador, $modelo, $tabla){
		
		
		// echo 'crear catalogo, controlador: '.$controlador.' tabla: '.$tabla.'<br/> ';
		$sql="SHOW COLUMNS FROM $tabla";
		$mod=$this->getModel();
		$res=$mod->ejecutarSql($sql);
		// print_r($res);
		$fields=array();
		foreach($res['datos'] as $key=>$value ){		
			$fields[]=$value['Field'];
		}
		// print_r($fields);
		//en la carpeta controladores crea el controlador
		// ob_start();
		$resp1=crear_controlador($controlador, $modelo,$fields);
		$resp2=crear_modelo($modelo, $tabla,$fields);
		$resp3=crear_buscador($controlador, $modelo,$fields);
		$resp4=crear_buscadorjs($controlador, $modelo,$fields);
		$resp5=crear_editor($controlador, $modelo, $fields);
		$resp6=crear_editorjs($controlador, $modelo,$fields);		
		// ob_end_clean();
		// echo json_encode($res);
	}
	function guardar(){
		ob_start();
			$resp = parent::guardar();
		ob_end_clean();
		
		$params=$_REQUEST['datos'];
		
		$this->crear_catalogo($_REQUEST['datos']['controlador'], $_REQUEST['datos']['modelo'], $_REQUEST['datos']['tabla']);
		echo json_encode($resp);
		
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		return parent::editar();
	}
	function buscar(){
		return parent::buscar();
	}
}
?>