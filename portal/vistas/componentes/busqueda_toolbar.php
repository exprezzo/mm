
<style type="text/css">		
	.crud_tb li{
		display:inline-block !important;
	}
	.crud_tb span{
		text-align:center !important;
	}	
</style>

<?php 	
	$tabId=$_REQUEST['tabId']; 	
	$domId = 'tb_'.$_PETICION->controlador.'_'.$tabId;	
?>

<div class="ribbon lista_toolbar ">
	<ul>
		 <li><a href="#<?php echo $domId; ?>">Basic Toolbar</a></li>
	</ul>
	<div id="<?php echo $domId; ?>" class="tbPedido">
		<div style="vertical-align:top;"> 
			<div  style="display:inline-block;margin-bottom:10px;">
				<div title="Acciones" class="wijmo-wijribbon-dropdownbutton">					
					<button title="Nuevo" class="" name="nuevo">
							<span class="btnNuevo"></span>
							<span>Nuevo</span>
					</button>				
				
					<button title="Editar" class="" name="editar">
						<span class="btnEditar"></span>
						<span>Editar</span>
					</button>
				
					<button title="Eliminar" class="" name="eliminar">
						<span class="btnEliminar"></span>
						<span>Eliminar</span>
					</button>
				
					<button title="Imprimir" class="" name="imprimir">
						<div class="btnImprimir"></div>
						<span>Imprimir</span>
					</button>									
				</div>							
			</div>
			<button title="Refresh" class="" name="refresh" style="position:absolute;;right:0;">
				<span class="btnRefresh"></span>
				<span>Actualizar</span>
			</button>	
		</div>
	</div>
</div>
