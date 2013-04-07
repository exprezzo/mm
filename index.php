<?php
	/**
	 * Punto de inicio
	 * */
	$a=1;
	if ($a==0){
		echo "El sistema está en mantenimiento, disculpe los inconvenientes.";		
	}else{
		header("Location: /sistema/index");
	}

?>