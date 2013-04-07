<?php
class UsuarioModelo extends Modelo{
	var $tabla="system_users";
	function nuevo($params){
		return parent::nuevo($params);
	}
	
	
	function guardar( $params ){
		$dbh=$this->getConexion();
		
		$id=$params['id'];
		// $nombre=$params['nombre'];
		
		if ( empty($id) ){
			//           CREAR
			// $sql='INSERT INTO '.$this->tabla.' SET nombre=:nombre, fecha_de_creacion= now()';
			$sql='INSERT INTO '.$this->tabla.' SET ';
			foreach($params as $key=>$val){
				if ($key=='pass'){
					$sql.='pass=AES_ENCRYPT(:pass, "'.PASS_AES.'"),';
				}else{
					$sql.="$key=:$key, ";
				}
				
			}
			$sql=substr($sql, 0, strlen($sql)-2 );
			
			// nombre=:nombre';
			$sth = $dbh->prepare($sql);							
			foreach($params as $key=>$val){
				$bind=":$key";
				if ($key=='pass' && empty($val) ){
					return array('success'=>false,'msg'=>'Ingrese un password');
				}
				$sth->bindValue($bind, $val,PDO::PARAM_STR);					
			}
			// $sth->bindValue(":nombre",$nombre,PDO::PARAM_STR);					
			$msg=$this->nombre.' Creado';	
		}else{
			//	         ACTUALIZAR
			// $sql='UPDATE '.$this->tabla.' SET nombre=:nombre WHERE id=:id, fecha_de_actualizacion=now()';
			// $sql='UPDATE '.$this->tabla.' SET nombre=:nombre WHERE id=:id';
			$sql='UPDATE '.$this->tabla.' SET ';
			foreach($params as $key=>$val){
				if ($key==$this->pk ) continue;
				
				if ($key=='pass' ){
					if ( !empty($val) ) $sql.='pass=AES_ENCRYPT(:pass, "'.PASS_AES.'"),';
				}else{
					$sql.="$key=:$key, ";
				}
				
			}
			$sql=substr($sql, 0, strlen($sql)-2 );
			$sql.=' WHERE '.$this->pk.'=:'.$this->pk;
			
			// nombre=:nombre';
			$sth = $dbh->prepare($sql);							
			foreach($params as $key=>$val){
				if ($key=='pass' && empty($val)) continue;
				$bind=":$key";							
				$sth->bindValue($bind, $val,PDO::PARAM_STR);					
			}
			
			$msg=$this->nombre.' Actualizado';	
		}
		$success = $sth->execute();
		
		
		if ($success != true){
			$error=$sth->errorInfo();			
			$success=false; //plionasmo apropósito
			$msg=$error[2];						
			$datos=array();
		}else{
			// $success = rowCount();			
			if ( empty( $id) ){
				$id=$dbh->lastInsertId();
			}
			$datos=$this->obtener(
				array( $this->pk =>$id )
			);
		}
		
		return array(
			'success'	=>$success,			
			'datos' 	=>$datos,
			'msg'		=>$msg
		);	
				
	}
	function borrar($params){
		return parent::borrar($params);
	}
	function editar($params){
		return parent::obtener($params);
	}
	function buscar($params){
		return parent::buscar($params);
	}
}
?>