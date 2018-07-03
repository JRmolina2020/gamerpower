
var tabla;

 function init(){
	limpiar();
	guardaryeditar(); 
	listar();
    $("#imagenmuestra").hide();
}
//Función limpiar
function limpiar()
{
	$("#idusuario").val("");
	$("#identi").val("");
	$("#apellido").val("");
	$("#direccion").val("");
	$("#telefono").val("");
	$("#correo").val("");
	$("#clave").val("");
	// ___________________________________________
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#cuadritoimagen").hide();
	$("#print").hide();
	$('#modal').on('shown.bs.modal', function () {
	$('#formulario').find('[name="identi"]').focus();});
}

//Función listar
function listar()

{
	 tabla=$('#listado').dataTable(
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

			url: '../controller/usuario.php?op=listar',
            type: "GET",
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

function guardaryeditar(e)
{
// VALIDATION formulario
$('#formulario') .bootstrapValidator({
	message: 'This value is not valid',
	fields: {


identi: {
			row: '.col-xs-4',
			message: 'identificacion invalida',
			validators: {
				notEmpty: {
					message: 'La identificacion es obligatoria'
				},
				integer: {
                        message: 'Digite un numero valido',
                         thousandsSeparator: '',
                            decimalSeparator: '.'
                    },

				stringLength: {
					min: 8,
					max: 12,
					message: 'Minimo 8 caracteres y Maximo 12'
				},
						regexp: {
						regexp: /^[a-zA-Z0-9_\.]+$/,
						message: 'No se permiten espacios',
						}
				
			}
		},
		nombre: {
			message: 'Nombre del vendedor invalido',
			validators: {
				notEmpty: {
					message: 'El nombre  es obligatorio y no puede estar vacio.'
				},
				
                    regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'Ingrese un nombre correcto,no se aceptan valores numericos',
      
                    },
                      
				stringLength: {
					min: 3,
					max: 20,
					message: 'Minimo 3 caracteres y Maximo 20 '
				},
			}
		},
		apellido: {
			message: 'Apellido del vendedor invalido',
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
		direccion: {
			message: 'Direccion invalida',
			validators: {
				notEmpty: {
					message: 'La direccion  es obligatoria y no puede estar vacia.'
				},
				
				stringLength: {
					min: 8,
					max: 30,
					message: 'Minimo 8 caracteres y Maximo 30 '
				},
			}
		},
		cargo: {
			message: 'Cargo  invalido',
			validators: {
				notEmpty: {
					message: 'El cargo  es obligatorio y no puede estar vacio.'
				},
				
				stringLength: {
					min: 4,
					max: 10,
					message: 'Minimo 4 caracteres y Maximo 10 '
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

// validaciones
		correo: {
			message: 'correo del usuario invalido',
			validators: {
				notEmpty: {
					message: 'El correo es obligatoria'
				},
				 emailAddress: {
                        message: 'Ingrese un correo valido'
                    },


				stringLength: {
					min: 8,
					max: 30,
					message: 'Minimo 8 caracteres y Maximo 30 caracteres '
				}
				
			}
		},

		 clave: {
                validators: {
                	notEmpty: {
					message: 'El password es obligatorio y no puede estar vacio.'
				},
				stringLength: {
					min: 4,
					max: 20,
					message: 'Maximo 20 caracteres'
				},
                    identical: {
                        field: 'confirmPassword',
                        message: 'Debera confirmar el Password'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    identical: {
                        field: 'clave',
                        message: 'El password no coincide con el anterior,verificar por favor'
                    }
                }
            },
		imagen: {
                    validators: {
                        file: {
                            extension: 'jpeg,jpg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 2097152,   // 2048 * 1024
                            message: 'Archivo denegado,Inserte una imagen valida'
                        },
                    }
                },
      	
	}
})

// end validaciones
.on('success.form.bv', function(e) {
// ---------------------------------------
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",false);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../controller/usuario.php?op=guardaryeditar",
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
	    	limpiar();	
	    	  $('#modal').modal('hide');
	    	  $('#formulario').bootstrapValidator("resetForm",true); 
	          tabla.ajax.reload();
	        
	    }

	});
	});
}

// end save
function mostrar(idusuario)
{
	$.post("../controller/usuario.php?op=mostrar",{idusuario : idusuario}, function(data, status)
	{
		data = JSON.parse(data);
		 $('#modal').modal('show');
		$("#cuadritoimagen").show();
	   	$("#idusuario").val(data.idusuario);
	   	$("#identi").val(data.identi);
	   	$("#nombre").val(data.nombre);
	   	$("#apellido").val(data.apellido);
	   	$("#telefono").val(data.telefono);
	   	$("#direccion").val(data.direccion);
		$("#telefono").val(data.telefono);
		$("#cargo").val(data.cargo);
		$("#correo").val(data.correo);
		$("#clave").val(data.clave);
		$("#confirmPassword").val(data.clave);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/usuario/"+data.imagen);
		$("#imagenactual").val(data.imagen);
 	})
}

//Función para eliminar registros
function eliminar(idusuario)
{
 swal({
  title: "Desea eliminar esta Usuario Recuerde una vez eliminado no se podra recuperar la informacion!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, ELIMINAR!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/usuario.php?op=eliminar", {idusuario : idusuario}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
   
  }
})
}

// desactivar registros
function bloquear(idusuario,condicion)
{
 swal({
  title: "Desea Bloquear a  este usuario, Recuerde una vez bloqueado no tendra acceso!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, ACEPTO!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/usuario.php?op=bloquear", {idusuario:idusuario , condicion : condicion} , function(e){
        		 swal(e);
	            tabla.ajax.reload();
	        });	
   
  }
})
}

function cerrarformulario(){
$("#cuadritoimagen").hide();
$('#formulario').bootstrapValidator("resetForm",true); 
limpiar()
}

init();





