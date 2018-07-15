
var tabla;

 function init(){
	
	limpiar();
	guardaryeditar();
	listar();
	
	// cargamos los provedores
	$.post("../controller/ingreso.php?op=selectProveedor", function(r){
	 $("#idproveedor").html(r);
	 $('#idproveedor').selectpicker('refresh');

	});
    
}

function activar(){
listarArticulos();
 $("#btnGuardar").hide();
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
    $("#neto").html("0");
      $("#iva").html("0");
       $("#totalfinal").html("0");

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
	    	$('.nav-tabs a[href="#listadox"]').tab('show');
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
        $("#btnAgregarArt").hide();  
           
      
       $('.nav-tabs a[href="#agregarx"]').tab('show');
        $("#idproveedor").val(data.idproveedor);
        $("#idproveedor").selectpicker('refresh');
        $("#num_comprobante").val(data.num_comprobante);
        $("#fecha_hora").val(data.fecha);
        $("#idingreso").val(data.idingreso);

    });
 
    $.post("../controller/ingreso.php?op=listarDetalle&id="+idingreso,function(r){
            $("#detalles").html(r);
    });
}
 
//Función para desactivar registros

function anular(idingreso)
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
  	$.post("../controller/ingreso.php?op=anular", {idingreso : idingreso}, function(e){
        		 swal(e);
	            tabla.ajax.reload();
       });	
  }
})
}

//Declaración de variables necesarias para trabajar con las compras y
//sus detalles

var cont=0;
var detalles=0;
//$("#guardar").hide();
$("#btnGuardar").hide();
function agregarDetalle(idarticulo,articulo)
  {
    var cantidad=1;
    var precio_compra=1;
    var precio_venta=1;
 
    if (idarticulo!="")
    {
        var subtotal=cantidad*precio_compra;
        var fila='<tr class="filas" id="fila'+cont+'">'+
        '<td><button type="button" class="btn btn-danger btn-xs" onclick="eliminarDetalle('+cont+')">x</button></td>'+
        '<td><input type="hidden" name="idarticulo[]" value="'+idarticulo+'">'+articulo+'</td>'+
        '<td><input type="number" name="cantidad[]" id="cantidad[]" value="'+cantidad+'"></td>'+
        '<td><input type="number" name="precio_compra[]" id="precio_compra[]" value="'+precio_compra+'"></td>'+
        '<td><input type="number" name="precio_venta[]" value="'+precio_venta+'"></td>'+
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
    $("#total_compra").val(total);
    // calculandoneto
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
$('#formulario').bootstrapValidator("resetForm",true); 
$('.nav-tabs a[href="#listadox"]').tab('show');
limpiar();
}







init();





