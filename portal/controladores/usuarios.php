<?php
require_once '../'.$_PETICION->modulo.'/modelos/Usuario_modelo.php';
class usuarios extends Controlador{
	var $modelo="Usuario";
	
	function crear(){
		if( $_SESSION['isLoged'] && $_SESSION['userInfo']['id'] == 1 ){
			$user=$_GET['user'];
			$pass=$_GET['pass'];
			$sql='INSERT INTO system_users SET nick=:nick, pass=AES_ENCRYPT(:pass,"'.PASS_AES.'")';
			$model=$this->getModel();
			$con=$model->getConexion();
			$sth=$con->prepare($sql);
			$sth->bindValue(':nick',$user, PDO::PARAM_STR);
			$sth->bindValue(':pass',$pass, PDO::PARAM_STR);
			
			$exito=$sth->execute();
			if ($exito){
				print_r( $model->getError($sth) ); 
			}
			
			echo "creado user: $user, pass: $pass";
		}else{
			echo '-_-';
		}
	
	}
	
	function nuevo(){		
		$fields=array('nick','pass','email','rol','fbid','id','name','picture','originalName');
		$vista=$this->getVista();				
		for($i=0; $i<sizeof($fields); $i++){
			$obj[$fields[$i]]='';
		}
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		
		
	}
	
	function guardar(){
		
		return parent::guardar();
	}
	function borrar(){
		return parent::borrar();
	}
	function editar(){
		// header("Content-Type: text/html;charset=utf-8");
		
		$id=empty( $_REQUEST['id'])? 0 : $_REQUEST['id'];
		$model=$this->getModel();
		$params=array(
			'id'=>$id
		);		
		$obj=$model->obtener( $params );		
		$obj['pass']='';
		$vista=$this->getVista();				
		$vista->datos=$obj;		
		
		global $_PETICION;
		$vista->mostrar('/'.$_PETICION->controlador.'/edicion');
		// print_r($obj);
	}
	function buscar(){
		return parent::buscar();
	}
}
?>