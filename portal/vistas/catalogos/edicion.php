
<script src="/web/<?php echo $_PETICION->modulo; ?>/js/catalogos/<?php echo $_PETICION->controlador; ?>/edicion.js"></script>

<script>			
	$( function(){		
		var config={
			tab:{
				id:'<?php echo $_REQUEST['tabId']; ?>'
			},
			controlador:{
				nombre:'<?php echo $_PETICION->controlador; ?>'
			},
			catalogo:{
				nombre:'Catalogo'
			}
			
		};				
		 var editor=new Edicioncatalogos();
		 editor.init(config);		
	});
</script>

	<div class="pnlIzq">
		<?php 	
			global $_PETICION;
			$this->mostrar('/componentes/toolbar');	
			if (!isset($this->datos)){		
				$this->datos=array();		
			}
		?>
		
		<form class="frmEdicion" style="padding-top:10px;">	
			<input type="hidden" name="id" class="txtId" value="<?php echo $this->datos['id']; ?>" />	
			<?php
				foreach($this->datos as $key=>$value){
					if ($key=="id") continue;
			?>
					<div class="inputBox" style="margin-bottom:8px;display:block;margin-left:10px;width:100%;" autoFocus >
						<label style=""><?php echo $key; ?>:</label>
						<input type="text" name="<?php echo $key; ?>" class="txt_<?php echo $key; ?>" value="<?php echo $value; ?>" style="width:500px;" />
					</div>
			<?php	}
			?>
	</div>
</div>
