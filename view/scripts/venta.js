
var tabla;

 function init(){
	guardaryeditar();
	listar();
 
	// cargamos el objecto select con nuestros clientes
	 $.post("../controller/venta.php?op=selectCliente", function(r){
	 $("#idcliente").html(r);
	 $('#idcliente').selectpicker('refresh');

	});
    
}

function activar(){
listarArticulos();
 $("#btnGuardar").hide();
 $("#btnAgregarArt").show();
fecha_actual();
}
//Función limpiar 
function limpiar()
{
	$("#idcliente").val("");
  $("#idventa").val("");
	$("#cliente").val("");
	$("#num_comprobante").val("");
  $(".filas").remove();
  $("#total").html("0.000");
  $("#neto").html("0.000");
  $("#iva").html("0.000");
  $("#totalfinal").html("0.000");
}

// obtener la fecha actual de nuestro sistema
function fecha_actual(){
    //Obtenemos la fecha actual
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

			url: '../controller/venta.php?op=listar',
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


//Función ListarArticulos en el modal para acceder a los productos
//y realizar la venta
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
                    url: '../controller/venta.php?op=listarArticulosVenta',
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


function guardaryeditar(e)
{
// VALIDATION formulario
$('#formulario') .bootstrapValidator({
	message: 'This value is not valid',
	fields: {
		num_comprobante: {
			message: 'Numero de comprobante invalido',
			validators: {
				notEmpty: {
					message: 'Este campo es requerido'
				},
				stringLength: {
					min: 3,
					max: 5,
					message: 'minimo 3 caracteres maximo 5'
				},
				
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
	url: "../controller/venta.php?op=guardaryeditar",
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
	    	$('.nav-tabs a[href="#listadox"]').tab('show');
	    	  $('#formulario').bootstrapValidator("resetForm",true); 
	          listar();
	    }

	});
	});
}

// Mostrar la informacion de la venta realizada,mostramos primero que todo
// los datos del cliente a quien se le hizo la venta y los productos que llevo
function mostrar(idventa)
{
    $.post("../controller/venta.php?op=mostrar",{idventa : idventa}, function(data, status)
    {
        data = JSON.parse(data);  
        $('.nav-tabs a[href="#agregarx"]').tab('show');
       
         $("#btnGuardar").hide();
         $("#btnAgregarArt").hide();  
        $("#idcliente").val(data.idcliente);
        $("#idcliente").selectpicker('refresh');
        $("#num_comprobante").val(data.num_comprobante);
        $("#fecha_hora").val(data.fecha);
        $("#idventa").val(data.idventa);
    });
 // en esta parte es donde mostramos los detalles de los productos llevados por el cliente
    $.post("../controller/venta.php?op=listarDetalle&id="+idventa,function(r){
            $("#detalles").html(r);
    }); 
}

 
//Función para anular una venta,por x o y razon, cada venta anulada obtendra en su
//fuente de dato un atributo anulado el cual no se sumara a la venta total del dia o
//inventario
function anular(idventa)
{
 swal({
  title: "Desea anular esta venta?!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'SI, Anular!'
}).then((result) => {
  if (result.value) {
  	$.post("../controller/venta.php?op=anular", {idventa : idventa}, function(e){
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
function agregarDetalle(idarticulo,articulo,precio_venta)
  {
    var cantidad=1; 
    var descuento=0;
 
    if (idarticulo!="")
    {
        var subtotal=cantidad*precio_venta;
        var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger btn-xs" onclick="eliminarDetalle('+cont+')">x</button></td>'+
        '<td><input type="hidden"  name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
        '<td><input type="number" class="form-control" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input type="number" disabled class="form-control" name="precio_venta[]" id="precio_venta[]" value="'+precio_venta+'"></td>'+
        '<td><input type="number" class="form-control" name="descuento[]" value="'+descuento+'"></td>'+
        '<td><span name="subtotal" id="subtotal'+cont+'">'+subtotal+'</span></td>'+
        '<td><button type="button" onclick="modificarSubototales()" class="btn btn-info"><i class="fa fa-refresh"></i></button></td>'+
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
    var prec = document.getElementsByName("precio_venta[]");
    var desc = document.getElementsByName("descuento[]");
    var sub = document.getElementsByName("subtotal");
    for (var i = 0; i <cant.length; i++) {
        var inpC=cant[i];
        var inpP=prec[i];
        var inpD=desc[i];
        var inpS=sub[i];
        inpS.value=(inpC.value * inpP.value)-inpD.value;
        document.getElementsByName("subtotal")[i].innerHTML = inpS.value;
    }
    calcularTotales();
  }


  function calcularTotales(){
    // declarando variables para las operaciones
    // resultantes
    var sub = document.getElementsByName("subtotal");
    var total = 0.0;
    var iva = 0.18;
    var resuiva =0.0;
    var totalcfinal=0.0;
 
    for (var i = 0; i <sub.length; i++) {
     total += document.getElementsByName("subtotal")[i].value;
    }
    // calculando el total primero
    $("#total").html("S/. " + total);
    $("#total_venta").val(total);
    // calculado el neto de la venta
    $("#neto").html("S/. " + total);
    $("#total_neto").val(total);
    // calculando iva de la compra
    var resuiva = total*iva;
    $("#iva").html("S/. " + resuiva);
    $("#total_iva").val(resuiva);
    // calculando el total final
    var totalcfinal = total+resuiva;
     $("#totalfinal").html("S/. " + totalcfinal);
    $("#total_cfinal").val(totalcfinal);
    evaluar();
  }

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
 
 function eliminarDetalle(indice){
    $("#fila" + indice).remove();
    calcularTotales();
    detalles=detalles-1;
    evaluar();
  }

function cerrarformulario(){
 limpiar();
$('#formulario').bootstrapValidator("resetForm",true); 
$('.nav-tabs a[href="#listadox"]').tab('show');


}
init();





