var tabla;


 function init(){
	listarcliente();
	limpiarcliente();
	guardaryeditarcliente();	
	// $('#ciudad').selectpicker('refresh');


}
//Función limpiarcliente
function limpiarcliente()
{
	$("#cedula").val("");
	$("#nombre").val("");
	$("#apellido").val("");
	$("#telefono").val("");
	$("#ciudad").val("");
	$("#barrio").val("");
	$("#direccion").val("");
	$("#idcliente").val("");
	$('#modalcliente').on('shown.bs.modal', function () {
	$('#formulariocliente').find('[name="cedula"]').focus();});

}

//Función listarcliente
function listarcliente()
{
	tabla=$('#listadocliente').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		 
	           
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../controller/cliente.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditarcliente(e)
{
// VALIDATION formulariocliente
$('#formulariocliente') .bootstrapValidator({
	message: 'This value is not valid',
	feedbackIcons: {
   valid: 'fa fa-user',
            invalid: 'fa fa-exclamation-circle',
            validating: 'fa fa-sync-alt'
},



	fields: {
		// validaciones
		cedula: {
			row: '.col-xs-4',
			message: 'Cedula del cliente invalida',
			validators: {
				notEmpty: {
					message: 'La cedula es obligatoria'
				},
				integer: {
                        message: 'Digite un numero valido',
                         thousandsSeparator: '',
                            decimalSeparator: '.'
                    },

				stringLength: {
					min: 8,
					max: 12,
					message: 'Minimo 8 caracteres y Maximo 12 caracteres '
				},
						regexp: {
						regexp: /^[a-zA-Z0-9_\.]+$/,
						message: 'No se permiten espacios',
						}
				
			}
		},
		nombre: {
			message: 'Nombre del acliente invalido',
			validators: {
				notEmpty: {
					message: 'El nombre  es obligatorio y no puede estar vacio.'
				},
				
                    regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'Ingrese un nombre correcto,no se aceptan valores numericos'
                    },
				stringLength: {
					min: 3,
					max: 20,
					message: 'Minimo 3 caracteres y Maximo 20 '
				},
			}
		},
		apellido: {
			message: 'Apellido del cliente invalido',
			validators: {
				notEmpty: {
					message: 'El Apellido  es obligatorio y no puede estar vacio.'
				},
				 regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'Ingrese un apellido correcto,no se aceptan valores numericos'
                    },
				stringLength: {
					min: 3,
					max: 20,
					message: 'Minimo 3 caracteres y Maximo 20 '
				},
				
			}
		},
		telefono: {
			message: 'telefono del cliente invalida',
			validators: {
				notEmpty: {
					message: 'El Telefono es obligatorio'
				},
				 numeric: {
                            message: 'Solo valores numericos',
                            
                        },
				stringLength: {
					min: 5,
					max: 12,
					message: 'Minimo 5 caracteres y Maximo 12 caracteres '
				},
						regexp: {
						regexp: /^[a-zA-Z0-9_\.]+$/,
						message: 'No se permiten espacios'
						}
				
			}
		},
	}
})

// end validaciones
.on('success.form.bv', function(e) {
// ---------------------------------------

	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulariocliente")[0]);

	$.ajax({
		url: "../controller/cliente.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	    	swal({
	    		position: 'top-end',
	    		type: 'success',
	    		title: datos,
	    		showConfirmButton: false,
	    		timer: 1500
	    	});  
	    	limpiarcliente();	
	    	  $('#modalcliente').modal('hide');
	    	  $('#formulariocliente').bootstrapValidator("resetForm",true); 

	          tabla.ajax.reload();
	        
	    }

	});
	});
}

// end save

function mostrarcliente(idcliente)
{

	$.post("../controller/cliente.php?op=mostrar",{idcliente : idcliente}, function(data, status)
	{
		data = JSON.parse(data);		
	   $('#modalcliente').modal('show');
		$("#cedula").val(data.cedula);
		$("#nombre").val(data.nombre);
		$("#apellido").val(data.apellido);
		$("#telefono").val(data.telefono);
	    $("#ciudad").val(data.ciudad).change();
		$("#barrio").val(data.barrio);
		$("#direccion").val(data.direccion);
		$("#idcliente").val(data.idcliente);
 	})
}


//Función para eliminar registros
function eliminarcliente(idcliente)
{
 swal({
  title: "Desea eliminar este cliente Recuerde una vez eliminado no se podra recuperar la informacion!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, ELIMINAR!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/cliente.php?op=eliminar", {idcliente : idcliente}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
   
  }
})
}

function permiso(){
  swal({
  title: 'Uste no tiene permiso',
  animation: true,
  customClass: 'animated tada'
})
}

// FUNCION AGREGAR MASCOTA RIDERRECION

function AgregarMascotacliente(idcliente){
 window.location="mascota.php?op="+idcliente};

function cerrarformulariocliente(){
$('#formulariocliente').bootstrapValidator("resetForm",true); 
limpiarcliente();
}

init();