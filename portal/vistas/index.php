<?php
if ( !isset($_SESSION['isLoged'])|| $_SESSION['isLoged']!=true ){
	header ('Location: /'.$_PETICION->modulo.'/user/login'); exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="us">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title><?php echo NOMBRE_APL; ?></title>
	<!--jQuery References-->
	<!--link href="/js/jquery-ui-1.9.2.custom/css/flick/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
	<script src="/web/libs/jquery-1.8.3.js"></script>
	<script src="/web/libs/jquery-ui-1.9.2.custom/jquery-ui-1.9.2.custom.js"></script>  
	
	
	<!--Theme-->
	<!--link href="http://cdn.wijmo.com/themes/rocket/jquery-wijmo.css" rel="stylesheet" type="text/css"  /-->
	<?php 
		global $_TEMAS;
		//$rutaTema=$_TEMAS[TEMA];
		
		$rutaTema=getUrlTema('artic');
		$rutaTema=getUrlTema(TEMA);
		
		$rutaMod='/web/'.$_PETICION->modulo.'/css/mods/black-tie/black-tie.css';
	?>
	
	<!--link href="http://cdn.wijmo.com/themes/arctic/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->
	<link href="<?php echo $rutaTema; ?>" rel="stylesheet" type="text/css" />
	<!--link href="<?php //echo $rutaMod; ?>" rel="stylesheet" type="text/css" /-->
	
	<!--link href="/css/mods/rocket/mods.css" rel="stylesheet" type="text/css" /-->		
	<!--link href="/css/themes/cobalt/jquery-wijmo.css" rel="stylesheet" type="text/css" title="rocket-jqueryui" /-->		
	
	<!--Wijmo Widgets CSS-->	
	<link href="/web/libs/Wijmo.2.3.2/Wijmo-Complete/css/jquery.wijmo-complete.2.3.2.css" rel="stylesheet" type="text/css" />
	<link href="/web/libs/Wijmo.2.3.2/Wijmo-Open/css/jquery.wijmo-open.2.3.2.css" rel="stylesheet" type="text/css" />			
	<!--link href="/css/themes/blitzer/jquery-ui-1.9.2.custom.css" rel="stylesheet"-->	
	<!--Wijmo Widgets JavaScript-->
	<script src="/web/libs/Wijmo.2.3.2/Wijmo-Complete/js/jquery.wijmo-complete.all.2.3.2.js" type="text/javascript"></script>
	<script src="/web/libs/Wijmo.2.3.2/Wijmo-Open/js/jquery.wijmo-open.all.2.3.2.js" type="text/javascript"></script>		
	<!-- Gritter -->
	<link href="/web/libs/Gritter-master/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<script src="/web/libs/Gritter-master/js/jquery.gritter.min.js" type="text/javascript"></script>
	
	
	<script src="/web/libs/shortcut.js"></script>  
	
	<link href="/web/<?php echo $_PETICION->modulo; ?>/css/estilos.css" rel="stylesheet" type="text/css" />
	<script src="/web/<?php echo $_PETICION->modulo; ?>/js/funciones.js" type="text/javascript"></script>
	<script src="/web/<?php echo $_PETICION->modulo; ?>/js/TabManager.js" type="text/javascript"></script>
	<script src="/web/<?php echo $_PETICION->modulo; ?>/js/navegacion_en_tabla.js" type="text/javascript"></script>
	<link href="/sistema/cssmenu" rel="stylesheet" type="text/css" />
	<script src="/web/<?php echo $_PETICION->modulo; ?>/js/navegacion_en_tabla_agrupada.js" type="text/javascript"></script>
	
	<script type="text/javascript">		
		kore={
			modulo:'<?php echo $_PETICION->modulo; ?>',
			controlador:'<?php echo $_PETICION->controlador; ?>',
			accion:'<?php echo $_PETICION->accion; ?>',
			decimalPlacesMoney:2
			// dafault:{
				// modulo:
				// controlador:
				// accion:
			// }			
		};
		
		salir=function(){
			window.location='/'+kore.modulo+'/user/logout';
		}
		$(function () {			
			shortcut.add("Ctrl+S", 
				function() { 
					var tab=$('#tabs > div[aria-hidden="false"]');
					var tabObj = tab.data('tabObj');
					if (tabObj!=undefined && tabObj.guardar!=undefined){
						tabObj.guardar();
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			);  
			
			shortcut.add("Ctrl+Alt+P", 
				function() { 
					 TabManager.add('/'+kore.modulo+'/pedidoi/verlista','Busqueda');
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			shortcut.add("Ctrl+Alt+O", 
				function() { 
					 TabManager.add('/'+kore.modulo+'/orden_compra/index','Busqueda',1);
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			shortcut.add("Ctrl+Alt+W", 
				function() { 
					//busca el tab seleccionado
					var tab=$('#tabs > div[aria-hidden="false"]');
					var idTab=tab.attr('id');					
					var tabs=$('#tabs > div');
					for(var i=0; i<tabs.length; i++){
						if ( $(tabs[i]).attr('id') == idTab ){
							$('#tabs').wijtabs('remove', i);
						}
					}
					
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			shortcut.add("Ctrl+Alt+N", 
				function() { 
					var tab=$('#tabs > div[aria-hidden="false"]');
					var tabObj = tab.data('tabObj');
					if (tabObj!=undefined && tabObj.nuevo!=undefined){
						tabObj.nuevo();
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			shortcut.add("Delete", 
				function() { 
					var tab=$('#tabs > div[aria-hidden="false"]');
					var tabObj = tab.data('tabObj');
					if (tabObj!=undefined && tabObj.borrar!=undefined){
						tabObj.borrar();
					}
					
				}, 
				{ 'type':'keydown', 'propagate':false, 'target':document} 
			); 
			
			$.extend($.gritter.options, { 
				position: 'bottom-right', // defaults to 'top-right' but can be 'bottom-left', 'bottom-right', 'top-left', 'top-right' 
				fade_in_speed: 'medium', // how fast notifications fade in (string or int)
				fade_out_speed: 2000, // how fast the notices fade out
				time: 6000 // hang on the screen for...
			});
			
			TabManager.init('#tabs');
			
			//Agregar opcion para salir
			
			ajustarTab(); //Ajusta la altura al tamaño en relacion al tamaño de la pantalla
			iniciarLinkTabs(); //A los objetos con atributo linkTab=true,  se les agrega comportamiento ajax para abrir tabs.
			
			// TabManager.add('/'+kore.modulo+'/general/welcome','Bienvenido');
			// TabManager.add('/'+kore.modulo+'/pedidoi/verlista','Busqueda');
			// TabManager.add('/'+kore.modulo+'/usuarios/busqueda','Usuarios',1,'');							 
			// TabManager.add('/'+kore.modulo+'/catalogos/busqueda','Busqueda',0);
			
			TabManager.add('/'+kore.modulo+'/sistema/menu','Menu',0,'tabMenu');
			<?php 
			
			foreach($this->catalogos as $cat){
				// echo 'TabManager.add(\'/\'+kore.modulo+\'/'.$cat['controlador'].'/busqueda\',\'Busqueda\',0);';
			}
			?>
			// TabManager.add('/'+kore.modulo+'/series/busqueda','Busqueda',0);
			// TabManager.add('/'+kore.modulo+'/estadopedidos/busqueda','Busqueda',0);
			// TabManager.add('/'+kore.modulo+'/stocks/busqueda','Busqueda',0);
			// TabManager.add('/'+kore.modulo+'/productos/busqueda','Busqueda',0);
			// TabManager.add('/'+kore.modulo+'/catalogos/busqueda','Busqueda',0);
						
			//TabManager.add('/'+kore.modulo+'/'+kore.controlador+'/'+kore.accion+'/');
			
			//TabManager.add('/'+kore.modulo+'/pedidoi/pedido');
			//TabManager.add('/'+kore.modulo+'/pedidoi/editar/580');
			//$('#tabs > ul').append('');
			
			$(window).resize( function() {
			  ajustarTab();
			});
			
			$('.user_widget a').mouseenter(function(){
				$(this).addClass('ui-state-hover');
			});			
			$('.user_widget a').mouseleave(function(){
				$(this).removeClass('ui-state-hover');
			});
			
			$('.header_empresa').mouseenter(function(){
				$(this).addClass('ui-state-hover');
			});
			$('.header_empresa').mouseleave(function(){
				$(this).removeClass('ui-state-hover');
			});
			
			//$("#splitter").wijsplitter({ orientation: "horizontal" });
			
			 $(".accesos_directos").wijcarousel({
                display: 12,
                step: 4,
                orientation: "horizontal"
            });			
			
			$('.link-salir').mouseenter(function(){
				$(this).addClass('ui-state-hover');
			});
			$('.link-salir').mouseleave(function(){
				$(this).removeClass('ui-state-hover');
			});
		});
		
		
	</script>
	<style type="text/css">		
		@media only screen and (max-width: 999px) {	  } 									/* rules that only apply for canvases narrower than 1000px */
		@media only screen and (device-width: 768px) and (orientation: landscape) {} 		/* rules for iPad in landscape orientation */
		@media only screen and (min-device-width: 320px) and (max-device-width: 480px) {}	/* iPhone, Android rules here */		
		.link{cursor:pointer;}
		.ui-tabs .ui-tabs-nav{	/* border-bottom:0; */	}
		 /*.ui-tabs .ui-tabs-hide {display: inline-block !important;}		*/
		 .tbPedido.ui-tabs-hide {display: inline-block !important;}		
		.main_header{display: none;width: 100%;border: 0;}
		
		.wijmo-wijsplitter-h-panel1.ui-resizable{
				transition:height .5s;
				-moz-transition:height .5s; 			/* Firefox 4 */
				-webkit-transition:height .5s; 			/* Safari and Chrome */
				-o-transition:height .5s; 				/* Opera */					
		}
		
		.eliminado td{
			background-color:#F9DADA !important;
		}
		#tabs > ul > li.ui-state-active{
			background: #ffe475 url(images/ui-bg_inset-hard_100_ffe475_1x100.png) bottom repeat-x !important;
		}
	</style>
	
</head>
<body style="padding:0; margin:0;" class="" >	
	<div id="splitter">
		<div class="main_header">
			<div style="padding:0px 0 0px 0px; float:left;position:relative;">
				<a class="header_empresa ui-state-default" href="/index"><span style="margin:8px;"><?php echo NOMBRE_APL; ?></span></a>
			</div>	
					
			<div class="user_widget" >
				<a class ="left ui-state-default" href="/<?php echo $_PETICION->modulo; ?>/user/perfil" tablink="true">Perfil</a>
				<a class ="right ui-state-default" href="/<?php echo $_PETICION->modulo; ?>/user/logout" tablink="false">Salir</a>
			</div>						
			
			<?php $this->mostrar('general/accesos_directos'); ?>
		</div>
		<div id="tabs">
			 <ul>			
			</ul>		
		</div>	
		
		<div class="ui-state-default link-salir" style="position:absolute;right:0;top:0;"><a onclick="salir()" href="#" >Salir</a></div>
		
	</div>
	
	

	 
</body>
</html>

