$(document).ready(function(){
	$("#TrabajadoresForm").validationEngine('attach',{autoHidePrompt:true,autoHideDelay:3000});
	$(".SelectAjax").SelectAjax();

 //--------  nombreTableAccion (..ta)
	var TrabajadoresTA = new DTActions({
		'conf': '010',
		'idtable': 'trabajadores_table',
		'EditFunction': function(nRow, aData, iDisplayIndex) {		
			$("#btn-reg-trabajadores").hide();
			$("#btn-editar-trabajadores").show();
	  		$('#modalTrabajadores').modal('show');
	  		$("#nombres").val(aData.cPersonalNom);	  				
	  		$("#apellidos").val(aData.cPersonalApe);
	  		$("#fechanacimiento").val(aData.dPersonalFec);	  		
	  		$("#edad").val(aData.cPersonalEdad);
	  		$("#dni").val(aData.cPersonalDNI);	  		
	  		$("#telefono").val(aData.cPersonalTelf);
	  		$("#email").val(aData.cPersonalEmail);
	  		$("#sexo").val(aData.cPersonalSexo);	  		
	  		$("#cargo").val(aData.nCargo_id);
	  		$("#estado").val(aData.cPersonalEst);
	  		$("#idTrabajadores").val(aData.nPersonal_id);
		},
	});
//Init------------------------------------>

    TrabajadoresRowCBF = function(nRow, aData, iDisplayIndex){
		TrabajadoresTA.RowCBFunction(nRow, aData, iDisplayIndex);	
	};

	var TrabajadoresOptions = {
		"aoColumns":[
			{ "mDataProp": "cPersonalNom"},
            { "mDataProp": "cPersonalApe"},
            { "mDataProp": "cPersonalDNI"},		              
            { "mDataProp": "cPersonalTelf"},		              	              
            { "mDataProp": "estadolabel"}
				],
		"fnCreatedRow": TrabajadoresTA.RowCBFunction
	};
	var TrabajadoresTable = createDataTable2('trabajadores_table',TrabajadoresOptions);

	//mostrar Registrar Trabajador------------------------------------>
	$('#btn-reg').click(function(e){
		e.preventDefault();
		$('#modalTrabajadores').modal('show');
	});

	//----------------------------------------------------------
    var successTrabajador = function(){    	
		$('#modalTrabajadores').modal('hide');
		$("#TrabajadoresForm").reset();
		TrabajadoresTable.fnReloadAjax()
	}

	//--funcion de los botones

	$("#btn-reg-trabajadores").click(function(event){
		event.preventDefault();
		if($("#TrabajadoresForm").validationEngine('validate'))
		{
			enviar($("#TrabajadoresForm").attr("action-1"),{formulario:$("#TrabajadoresForm").serializeObject()}, successTrabajador, null);
		}
	});
	$("#btn-editar-trabajadores").click(function(event){
		event.preventDefault();
		if($("#TrabajadoresForm").validationEngine('validate'))
			enviar($("#TrabajadoresForm").attr("action-2"),{formulario:$("#TrabajadoresForm").serializeObject()}, successTrabajador, null);
	});
	


});