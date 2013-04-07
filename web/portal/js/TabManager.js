var tab_counter = 1; 
var TabManager={
	init:function(target){
		$tabs = $(target).wijtabs({		   
		   tabTemplate: '<li><a  href="#{href}">#{label}</a> <span class="ui-icon ui-icon-close">Remove Tab</span></li>',
		    beforeremove: function (e, params) { 
				//obtener el tab con ese index, ejecutarle la funcion beforeclose, si es que tiene
				var tab=$(params.el).data('tabObj');				
				if (tab!=undefined && tab.close != undefined){
					return tab.close();
				}else{
					return true;
				}				
			} 		   
		});
		this.tabs=$tabs;

		$('#tabs span.ui-icon-close').live('click', function () {
			var index = $('li', $tabs).index($(this).parent());
			$tabs.wijtabs('remove', index);
		});
				
		this.refresLayout();
	},
	refresLayout:function(){		
		$('#tabs').height(screen.height);
	},
	add:function(url,titulo,id,iconCls){
		if (titulo == undefined) titulo='Nuevo Tab';
		id = id || 0;
		var tabId = 'tabs-' + tab_counter;
		
		var objId = url+'?id='+id;
		objId = objId.toLowerCase();
		if (id!=0){
			if ( this.seleccionarTab(objId) == true)
				return true;
		}		
		var res=$tabs.wijtabs('add','#'+ tabId, titulo);	//Los agrego antes de la peticion ajax.		
		
		tab_counter++;
		
		$('#'+ tabId ).attr('objId',objId);
		if (iconCls!=undefined){
			var tab=$('a[href="#'+tabId+'"]');
			tab.addClass(iconCls);
		}
		var me=this;
		$.ajax({
			type: "POST",
			url: url,
			data: { tabId:tabId, id:id }
		}).done(function( response, b, c , d ) {
			
			//alert(tabId);
			 $('#'+ tabId ).html(response);				
			 
			 me.seleccionarTab(objId);
			 $tabs.wijtabs('select',tabId);			
			 
			var tabObj = $('#'+ tabId ).data('tabObj');
			
			if (tabObj != undefined ){
				if (tabObj.activate != undefined){
					tabObj.activate();
				}
				
			}
			
			 //$('#'+ tabId ).html(response);				
		});
	},
	seleccionarTab:function(objId){
		
		var tabListaPedidos = $('#tabs > div[objId="'+objId+'"]'); //role="tabPanel",		
		if (tabListaPedidos.length == 0){			
			return false;
		}else if (tabListaPedidos.length > 0){ //Seleccionar el tab											
			
			var tabs = $('#tabs > div[role="tabpanel"]');
			//busca el indice del tab
			var idTab=$(tabListaPedidos).attr('id');
			
			var tabs=$('#tabs > div');
			for(var i=0; i<tabs.length; i++){
				if ( $(tabs[i]).attr('id') == idTab ){										
					$("#tabs").wijtabs('select', i);
					return true;
				}
			}
			
			
			// return true;
		}
	}
};