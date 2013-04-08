<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html >
	<head>			
		<title><?php echo NOMBRE_APL; ?></title>
		<link rel="shortcut icon" href="/favicon.ico"/>		
		<!--jQuery References-->
		<!--link href="/js/jquery-ui-1.9.2.custom/css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
		<script src="/web/libs/jquery-1.8.3.js"></script>
		<script src="/web/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>  
		<!--Theme-->
		<!--link href="http://cdn.wijmo.com/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
		<!--link href="/css/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
		<link href="http://cdn.wijmo.com/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css" />		
		<link href="/css/mods/<?php echo TEMA; ?>/mods.css" rel="stylesheet" type="text/css" />		
		<!--Wijmo Widgets CSS-->	
		<link href="/web/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
		<link href="/web/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />		
		<!--Wijmo Widgets JavaScript-->
		<script src="/web/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.min.js" type="text/javascript"></script>
		<script src="/web/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.min.js" type="text/javascript"></script>		
		<script type="text/javascript">
			$(document).ready(function () {
				kore={
					modulo:'<?php echo $_PETICION->modulo; ?>'
				}
				var errorPass="<? echo !empty($this->errores['pass'])? $this->errores['pass'] : ''; ?>";
				var errorUsername="<? echo !empty($this->errores['username'])? $this->errores['username'] : ''; ?>";
				
				
				$(":input[type='text'],:input[type='password']").wijtextbox();
				if (errorPass!=''){
					var ttip=$("input[name='pass']").wijtooltip({content:errorPass,position:{my: 'left bottom',at: 'right center'}});
					ttip=$("input[name='pass']").wijtooltip('show');				
				}
				if (errorUsername!=''){
					var ttip=$("input[name='username']").wijtooltip({content:errorUsername,position:{my: 'left bottom',at: 'right center'}});
					ttip=$("input[name='username']").wijtooltip('show');				
				}
				$('button').click(function(){
					$(this).addClass('activo');
				});
				
			});
		</script>
		<link href="/web/<?php echo $_PETICION->modulo; ?>/css/login.css" rel="stylesheet" type="text/css" />		
		<style type="text/css">
			
			
			
		</style>
	</head>

	<body onload="" style="" class="body">		
		<form id="forLogin" action="/<?php echo $_PETICION->modulo; ?>/user/login" method="POST" >
			<div class="header ui-state-default" style="text-align:center;">LOGIN</div>			
			
			<div class="contenido">
				
				<br>
				<? if (!empty($this->errores['general']) ) echo $this->errores['general']; ?>
				
				
				
				<div class="inputBox">
					
					<input id="txtLogUsu" name="username" type="text" placeholder="Nombre de usuario" value="<? if (!empty($this->valores['username']) ) echo $this->valores['username']; ?>"/>				
				</div>
				<br>
				<div class="inputBox">					
					<input id="txtLogCon" name="pass" Type="password" placeholder="Contrase&ntilde;a de Usuario" />				
				</div>
				
								<br />
				<div style="text-align:center;" class="btnEntrar">
					<button id="botLogAce" type="submit" name="submit" value="Iniciar" >Entrar</button>
				</div>
			</div>			
		</form>			
	</body>
</html>