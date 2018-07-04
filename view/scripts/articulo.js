
var tabla;

 function init(){
	
	limpiar();
	guardaryeditar();
	listar();
    $("#imagenmuestra").hide();
//Cargamos los items al select categoria
	$.post("../controller/articulo.php?op=selectCategoria", function(r){
	 $("#idcategoria").html(r);
	 $('#idcategoria').selectpicker('refresh');

	});

}
//Función limpiar
function limpiar()
{
	$("#idcategoria").val("");
	$("#idarticulo").val("");
	$("#nombre").val("");
	$("#codigo").val("");
	$("#stock").val("");
	$("#descripcion").val("");
	// ___________________________________________
	$("#imagenmuestra").attr("src","");
	$("#imagenactual").val("");
	$("#cuadritoimagen").hide();
	$("#print").hide();
	$('#modal').on('shown.bs.modal', function () {
	$('#formulario').find('[name="codigo"]').focus();});
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

			url: '../controller/articulo.php?op=listar',
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


codigo: {
			row: '.col-xs-4',
			message: 'Codigo del articulo invalido',
			validators: {
				notEmpty: {
					message: 'El codigo es obligatorio'
				},
				integer: {
                        message: 'Digite un numero valido',
                         thousandsSeparator: '',
                            decimalSeparator: '.'
                    },

				stringLength: {
					min: 3,
					max: 8,
					message: 'Minimo 5 caracteres y Maximo 8'
				},
						regexp: {
						regexp: /^[a-zA-Z0-9_\.]+$/,
						message: 'No se permiten espacios',
						}
				
			}
		},

		nombre: {
			message: 'Nombre del aritculo invalido',
			validators: {
				notEmpty: {
					message: 'El Nombre de el articulo  es obligatorio y no puede estar vacio.'
				},
				stringLength: {
					min: 3,
					max: 20,
					message: 'Minimo 3 caracteres y Maximo 20 '
				},
				
			}
		},

		stock: {
			row: '.col-xs-4',
			message: 'Existencia del articulo invalida',
			validators: {
				notEmpty: {
					message: 'La existencia del articulo es obligatoria'
				},
				integer: {
                        message: 'Digite un numero valido',
                         thousandsSeparator: '',
                            decimalSeparator: '.'
                    },

                    between: {
                            min: 1,
                            max: 1000,
                            message: 'El rango debe ser igual a uno y menor a 1000'
                        },

				stringLength: {
					min: 1,
					max: 5,
					message: 'Minimo 1 caracteres y Maximo 5  '
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
           
		descripcion: {
			message: 'Descripcion del aritculo invalida',
			validators: {
				notEmpty: {
					message: 'La descripcion de el articulo  es obligatorio y no puede estar vacio.'
				},
				
			}
		},
		idcategoria: {
			message: 'Debe asignarle una categoria al articulo',
			validators: {
				notEmpty: {
					message: 'Debe asignarle una categoria al articulo'
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
		url: "../controller/articulo.php?op=guardaryeditar",
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
function mostrar(idarticulo)
{
	$.post("../controller/articulo.php?op=mostrar",{idarticulo : idarticulo}, function(data, status)
	{
		data = JSON.parse(data);
		 $('#modal').modal('show');
		$("#cuadritoimagen").show();
	   	$("#idarticulo").val(data.idarticulo);
	   	$("#idcategoria").val(data.idcategoria).change();
	   	$("#codigo").val(data.codigo);
		$("#nombre").val(data.nombre);
		$("#stock").val(data.stock);
		$("#descripcion").val(data.descripcion);
		$("#imagenmuestra").show();
		$("#imagenmuestra").attr("src","../files/articulo/"+data.imagen);
		$("#imagenactual").val(data.imagen);
		generarbarcode();


 	})
}

//Función para desactivar registros

function desactivar(idarticulo)
{
 swal({
  title: "Desea desactivar este articulo!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, Desactivar!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/articulo.php?op=desactivar", {idarticulo : idarticulo}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
  }
})
}

function activar(idarticulo)
{
	swal({
  title: "Desea activar esta articulo!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, Activar!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/articulo.php?op=activar", {idarticulo : idarticulo}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
  }
})
}
//Función para eliminar registros
function eliminar(idarticulo)
{
 swal({
  title: "Desea eliminar esta articulo Recuerde una vez eliminado no se podra recuperar la informacion!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, ELIMINAR!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/articulo.php?op=eliminar", {idarticulo : idarticulo}, function(e){
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

//función para generar el código de barras
function generarbarcode()
{
	codigo=$("#codigo").val();
	JsBarcode("#barcode", codigo);
	$("#print").show();
}

//Función para imprimir el Código de barras
function imprimir()
{
	var dato = document.formulario.codigo.value;
	if (dato=='') {
	}else{
	$("#print").printArea();	
	}
	
}
init();





