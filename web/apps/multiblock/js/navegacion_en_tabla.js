var NavegacionEnTabla=function(){
	this.eliminar=function(){	
		console.log("eliminar");
	};
	this.seleccionarLineaAnterior=function(){
		console.log("seleccionarLineaAnterior");
	};
	this.seleccionarSiguienteLinea=function(){
		console.log("seleccionarSiguienteLinea");
	};
	
	
	this.esCeldaEditable=function(){
		return true;
	};
	
	this.esUltimoRegistro=function(){return false;};
	this.siguientePagina=function(){
		var pi=$(this.targetSelector).wijgrid('option',"pageIndex");
		this.editarPrimero=true;
		$(this.targetSelector).wijgrid('option','pageIndex',pi+1);			 												
	}
	this.paginaAnterior=function(){
		var pi=$(this.targetSelector).wijgrid('option',"pageIndex");
		if (pi<0){
			this.celdaActual.row=0;
			this.celdaActual.col=0;
		}
		this.editarUltimo=true;
		$(this.targetSelector).wijgrid('option','pageIndex',pi-1);			 															
	}
	this.seleccionarCeldaAnterior=function(){
		this.celdaActual.col--;
		//al llegar ala ultima celda del registro, salta a la primera celda del siguiente registro.
		//si es el ultimo registro de la pagina
		if ( this.celdaActual.col < 0 ){
			this.celdaActual.col=this.numCols-1;
			this.celdaActual.row--;
			
			if ( this.celdaActual.row < 0  ){
				this.celdaActual.row=this.pageSize-1;
				return this.paginaAnterior();
			}
			// if ( this.celdaActual.row < 0  ){
		}
		
		
		if ( this.esCeldaEditable() ){
			this.editarCelda({
				col:this.celdaActual.col,
				row: this.celdaActual.row
			});
		}else{			
			this.seleccionarCeldaAnterior();
		}
	};
	this.seleccionarSiguienteCelda=function(){
		this.celdaActual.col++;
		//al llegar ala ultima celda del registro, salta a la primera celda del siguiente registro.
		//si es el ultimo registro de la pagina
		console.log("this.celdaActual"); console.log(this.celdaActual);
		console.log("this"); console.log(this);
		
		if ( this.celdaActual.col >= this.numCols ){
			this.celdaActual.col=0;
			this.celdaActual.row++;			
			if ( this.celdaActual.row >= this.pageSize  ){
				this.celdaActual.row=0;
				return this.siguientePagina();
			}
			
			var tr=$(this.targetSelector+' tbody tr');					
			var numRows=tr.length;	
			
			// console.log("seleccionarSiguienteCelda"); console.log(me);
			
			// alert("asd: "+numRows);
			
			// console.log();
			if (this.celdaActual.row >= numRows){
				this.celdaActual.row = numRows-1;
				this.celdaActual.col = this.numCols-1;
			}
			
		}
		
		
		if ( this.esCeldaEditable() ){
			this.editarCelda({
				col:this.celdaActual.col,
				row: this.celdaActual.row
			});
		}else{			
			this.seleccionarSiguienteCelda();
		}
	};
	this.editarCelda=function(celda){
		var row=celda.row, col=celda.col;		
		
		// var rowIdx=$(this.targetSelector+' tbody tr:nth-child('+(row+1)+')');		
		// var tdD=row.find('td:nth-child('+(col+1)+')');		
		
		$(this.targetSelector).wijgrid("currentCell",  col, row);
		$(this.targetSelector).wijgrid("beginEdit");
	};
	
	this.reset=function(){
	};
	this.init=function(params){
		this.tablaSel=params.targetSelector;
		this.targetSelector =params.targetSelector;
		this.pageSize =params.pageSize;
		var me=this;
		
		var tr=$(this.targetSelector+' thead tr:nth-child(1)');		
		var tds=tr.find('th');		
		
		this.numCols=tds.length;		
		
		
		$(this.targetSelector).bind("wijgridloaded", function (e) { 
			
			if (me.editarPrimero){
				me.editarPrimero=false;				
				$(me.targetSelector).wijgrid("currentCell",  me.celdaActual.col, me.celdaActual.row);				
				$(me.targetSelector).wijgrid("beginEdit");
			}
			if (me.editarUltimo){
				me.editarUltimo=false;				
				$(me.targetSelector).wijgrid("currentCell",  me.celdaActual.col, me.celdaActual.row);				
				$(me.targetSelector).wijgrid("beginEdit");
			}
			
			var tr=$(me.targetSelector+' tbody tr');					
			me.numRows=tr.length;							
		});
		
		
		$(params.targetSelector+' tbody tr').delegate('td','keydown', function(e) {
			
			var code = e.keyCode || e.which;
			code=parseInt(code);
			//ubicacion de la celda
			var col = $(this).parent().children().index( $(this) );
			var row = $(this).parent().parent().children().index( $(this).parent() );
			
			var celdaActual={
				col:col,
				row:row
			};
			
			
			me.celdaActual = celdaActual;
			
				
			if(e.keyCode==46){
				// me.eliminar();
			}else if(e.keyCode==13 && e.shiftKey){	
				//Saltar al siguiente registro				
				e.preventDefault();			
				e.stopPropagation();
				me.seleccionarLineaAnterior();				
			}else if(e.keyCode==13){	
				//Saltar al siguiente registro
				e.stopPropagation();
				e.preventDefault();							
				me.seleccionarSiguienteLinea();
				
			}else if(e.keyCode==9  && e.shiftKey){	
				e.preventDefault();	
				e.stopPropagation();				
				me.seleccionarCeldaAnterior();				
			}else if(e.keyCode==9 ){				
				e.stopPropagation();
				e.preventDefault();				
				me.seleccionarSiguienteCelda();
			}
		});
		
	}
	
}