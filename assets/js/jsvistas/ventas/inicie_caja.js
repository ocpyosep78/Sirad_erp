$(document).ready(function(){

	var successInicie_Caja = function(){
		$.unblockUI({
		    onUnblock: function(){
				//CargosTable.fnReloadAjax()
				$("#InicieCajaForm").reset();
			}
		})
	}

	$("#Abrir_caja").click(function(event){
		event.preventDefault();
		if($("#InicieCajaForm").validationEngine('validate'))
			// para vefiricar console.log($("#CargoForm").serializeObject());
			$.blockUI({ 
				onBlock: function()
				{
					enviar($("#InicieCajaForm").attr("action-1"),{formulario:$("#InicieCajaForm").serializeObject()}, successInicie_Caja, null)
				}
			});
	});

});