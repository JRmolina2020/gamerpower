var tabla;
 function init(){
	listarcategoria();
	guardaryeditarcategoria();	

	// $('#ciudad').selectpicker('refresh');

}
//Función limpiarcategoria
function limpiarcategoria()
{
	$("#nombre").val("");
	$("#idcategoria").val("");
	$("#descripcion").val("");
	$('#modalcategoria').on('shown.bs.modal', function () {
	$('#formulariocategoria').find('[name="nombre"]').focus();
});


}

//Función listarcategoria
function listarcategoria()
{
	tabla=$('#listadocategoria').dataTable(
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
					url: '../controller/categoria.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

function guardaryeditarcategoria(e)
{
// VALIDATION formulariocategoria
$('#formulariocategoria') .bootstrapValidator({
	message: 'This value is not valid',
	feedbackIcons: {
   valid: 'fa fa-check',
   invalid: 'fa fa-exclamation-circle',
    validating: 'fa fa-check'
},

	fields: {
		nombre: {
			message: 'Categoria invalida',
			validators: {
				notEmpty: {
					message: 'El nombre  de la categoria es invalido',
				},
                    regexp: {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: 'Ingrese una categoria correcta,no se aceptan valores numericos'
                    },
				stringLength: {
					min: 3,
					max: 20,
					message: 'Minimo 3 caracteres y Maximo 20 caracteres'
				},
				
			}
		},
		

		descripcion: {
			message: 'Descripcion invalida',
			validators: {
				notEmpty: {
					message: 'La Descripcion es obligatoria'
				},
				stringLength: {
					min: 7,
					max: 90,
					message: 'Minimo tres caracteres y Maximo 90 caracteres '
				},
				
			}
		},
		
	}
})

// end validaciones
.on('success.form.bv', function(e) {
// --------------------------------------
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#formulariocategoria")[0]);

	$.ajax({
		url: "../controller/categoria.php?op=guardaryeditar",
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
	    	limpiarcategoria();	
	    	  $('#modalcategoria').modal('hide');
	    	  $('#formulariocategoria').bootstrapValidator("resetForm",true); 

	          tabla.ajax.reload();
	        
	    }

	});
	});
}

// end save
function mostrar(idcategoria)
{

	$.post("../controller/categoria.php?op=mostrar",{idcategoria : idcategoria}, function(data, status)
	{
		data = JSON.parse(data);		
	   $('#modalcategoria').modal('show');
		$("#nombre").val(data.nombre);
		$("#descripcion").val(data.descripcion);
	    $("#ciudad").val(data.ciudad).change();
		$("#idcategoria").val(data.idcategoria);
 	})
}

//Función para desactivar registros
function desactivar(idcategoria)
{
 swal({
  title: "Desea desactivar esta Categoria!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, Desactivar!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/categoria.php?op=desactivar", {idcategoria : idcategoria}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
  }
})
}

function activar(idcategoria)
{
	swal({
  title: "Desea activar esta Categoria!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, Activar!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/categoria.php?op=activar", {idcategoria : idcategoria}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
  }
})
}

//Función para eliminar registros
function eliminar(idcategoria)
{
 swal({
  title: "Desea eliminar esta categoria Recuerde una vez eliminada no se podra recuperar la informacion!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, ELIMINAR!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/categoria.php?op=eliminar", {idcategoria : idcategoria}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
   
  }
})
}

function cerrarformulariocategoria(){
$('#formulariocategoria').bootstrapValidator("resetForm",true); 
limpiarcategoria();
}

init();