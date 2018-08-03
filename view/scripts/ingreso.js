
var tabla;

 function init(){
	
	
	guardaryeditar();
	listar();
  fecha_actual();
  listarArticulos();


	
	// cargamos los provedores
	$.post("../controller/ingreso.php?op=selectProveedor", function(r){
	 $("#idproveedor").html(r);
	 $('#idproveedor').selectpicker('refresh');

	});
    
}

function activar(){

 $("#btnGuardar").hide();
 $("#btnAgregarArt").show();

}
//Función limpiar
function limpiar()
{
	$("#idproveedor").val("");
	$("#proveedor").val("");
	$("#num_comprobante").val("");
	 $("#total_compra").val("");
    $(".filas").remove();
    $("#total").html("0");
     //Obtenemos la fecha actual
     fecha_actual();
  
}

function fecha_actual(){
  var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#fecha_hora').val(today);
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

			url: '../controller/ingreso.php?op=listar',
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


// listar articulos activos
function listarArticulos()

{
	 tabla=$('#tblarticulos').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		 
	           
		        ],
		"ajax":
				{

			url: '../controller/ingreso.php?op=listarArticulos',
            type: "GET",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 3,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}


function guardaryeditar(e)
{
   var cantidad= $('input[name="cantidad[]"]').val();
// VALIDATION formulario
$('#formulario') .bootstrapValidator({
	message: 'This value is not valid',
	fields: {
  num_comprobante: {
      row: '.col-xs-4',
      message: 'numero del comprobante invalido',
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
          max: 5,
          message: 'Minimo 3 caracteres y Maximo 5'
        },
            regexp: {
            regexp: /^[a-zA-Z0-9_\.]+$/,
            message: 'No se permiten espacios',
            }

      }
    },
   


	}
})

// end validaciones
.on('success.form.bv', function(e) {
// ---------------------------------------
	e.preventDefault(); //No se activará la acción predeterminada del evento
	// $("#btnGuardar").prop("disabled",false);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../controller/ingreso.php?op=guardaryeditar",
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
	    	$('.nav-tabs a:last').tab('show');
	    	  $('#formulario').bootstrapValidator("resetForm",true); 
	          listar();
	    }

	});
	});
}

// end save
function mostrar(idingreso)
{
    $.post("../controller/ingreso.php?op=mostrar",{idingreso : idingreso}, function(data, status)
    {
        data = JSON.parse(data);  
        // controles accion 
        $("#btnGuardar").hide();
         $('.nav-tabs a:first').tab('show')
         $('#cubitoagregar').hide();
         $("num_comprobante").prop('disabled', true);
        // 
        $("#idproveedor").val(data.idproveedor);
        $("#idproveedor").selectpicker('refresh');
        $("#num_comprobante").val(data.num_comprobante);
        $("#fecha_hora").val(data.fecha);
        $("#idingreso").val(data.idingreso);

    });
    //listar detalles de la compra efectuada
    $.post("../controller/ingreso.php?op=listarDetalle&id="+idingreso,function(r){
            $("#detalles").html(r);
    });
}
 
//Función para anular una compra registros
function anular(idingreso)
{
 swal({
  title: "Desea anular esta Compra!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, Anular compra!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/ingreso.php?op=anular", {idingreso : idingreso}, function(e){
        		 swal(e);
	            listar();
       });	
  }
})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles

var cont=0;
var detalles=0;
$("#btnGuardar").hide();
function agregarDetalle(idarticulo,articulo)
  {
    var cantidad=1;
    var precio_compra=1.0;
    var precio_venta=1;
 
    if (idarticulo!="")
    {
        var subtotal=parseFloat(cantidad*precio_compra);
        var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger btn-xs" onclick="eliminarDetalle('+cont+')"><i class="fa fa-trash"></i></button></td>'+
        '<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
        '<td><input type="number" onchange="modificarSubototales()"   class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input type="number" onchange="modificarSubototales()"  class="form-control" name="precio_compra[]" id="precio_compra[]" value="'+precio_compra+'"></td>'+
        '<td><input type="number" onchange="modificarSubototales()"  class="form-control" name="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><span name="subtotal" STYLE="color: red; font-size: 20pt" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
        '</tr>';
        cont++;
        detalles=detalles+1;
        $('#detalles').append(fila);
        modificarSubototales();
      }
      
    else
    {
        alert("Error al ingresar el detalle, revisar los datos del artículo");
    }
  }

function modificarSubototales()
  {
    var cant = document.getElementsByName("cantidad[]");
    var prec = document.getElementsByName("precio_compra[]");
    var sub = document.getElementsByName("subtotal");
 
    for (var i = 0; i <cant.length; i++) {
        var inpC=cant[i];
        var inpP=prec[i];
        var inpS=sub[i];
 
        inpS.value=inpC.value * inpP.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();
  
  }

 
  function calcularTotales(){
    var sub = document.getElementsByName("subtotal");
    var total = 0.0;
 
    for (var i = 0; i <sub.length; i++) {
        total += document.getElementsByName("subtotal")[i].value;
    }
    // calculando total de la compra
    $("#total").html("$/" + total);
    $("#total_compra").val(total);
    evaluar();
  }
 
 //validacion de boton guardar solo si hay detalles se muestra
 //para asi realizar la coprar
  function evaluar(){
    if (detalles>0)
    {
      $("#btnGuardar").show();
    }
    else
    {
      $("#btnGuardar").hide(); 
      cont=0;
    }
  }
 
 


 // 
 
  function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    calcularTotales();
    detalles=detalles-1;
    evaluar();
  }

function cerrarformulario(){
$('.nav-tabs a:last').tab('show');
$('#formulario').bootstrapValidator("resetForm",true); 
limpiar();
$('#cubitoagregar').show();
// redireccionar a listado de ingresos

}
init();





