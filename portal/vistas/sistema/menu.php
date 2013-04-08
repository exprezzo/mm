<style>
.menu_page_header h1{
	padding: 0;
	margin: 0;
}
.menu_page_header h3{
	display: inline-block;
	font-size: 14px;
	padding: 0;
	margin: 0;
	text-align: right;
	width: 163px;
}
.menu_ico{
	width:64px;
	height:64px;
}
.menu_item a{
	text-decoration:none;
}

.menu_item label{
	cursor: pointer;
	top: 41px;
	left: 75px;
	position: absolute;
}
.menu_item{
	list-style: none;
	position: relative;
	width: 200px;
	float: left;
	padding: 10px;
}
</style>

<div class="menu_page_header">
<h1 style="display:inline-block;"><?php echo $APP_CONFIG['nombre']; ?></h1>
<h3 style="display:block;font-size:14px;">Menu principal</h3>
</div>
<ul>
<?php

foreach($this->catalogos as $cat){
	
	echo '<li class="menu_item"><a  controlador="'.$cat['controlador'].'"  tablink="true" href="/'.$cat['controlador'].'/busqueda">'.
	'<img class="menu_ico" src="'.$cat['icono'].'" />'.
	'<label>'.$cat['nombre'].'</label></a></li>';
}
?>
</ul>
<script>
	$().ready(function(){
		var tabId='<?php echo $_REQUEST['tabId']; ?>';
		// $('#'+tabId).addClass('pedido');
		// alert('#'+tabId+'[tablink="true"]');
		var links=$('#'+tabId+' [tablink="true"]');
		
		$.each(links, function(index, element) {
			var link=$(element);
			if ( !link.attr )  return false;
			var destino=link.attr('href');
			link.attr('href','#');
			
			link.attr('tablink',false);
			link.addClass('link');
			
			var img=link.find('img');
			var ruta=img.attr('src');
			var controlador=link.attr('controlador');
						
			link.click(function(){			
				TabManager.add(destino,'Cargando...',0,'tab_'+controlador);
			});
		});
	});
</script>
