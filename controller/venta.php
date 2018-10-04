<?php 
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
require_once "../model/Venta.php";
$venta=new Venta();
$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";
switch ($_GET["op"]){
    case 'guardaryeditar':
    if (empty($idventa)){
        $rspta=$venta->insertar($idcliente,$idusuario,$num_comprobante,$fecha_hora,$total_venta,
        $_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["descuento"]);
        if ($rspta) {
            echo "Venta realizada con exito";
        }else{
            echo "Venta rechazada";
        }  
    }
    break;
    case 'anular':
    $rspta=$venta->anular($idventa);
    echo $rspta ? "Venta anulada" : "Venta no se puede anular";
    break;
    
    case 'mostrar':
    $rspta=$venta->mostrar($idventa);
        //Codificar el resultado utilizando json
    echo json_encode($rspta);
    break;
    
    case 'listarDetalle':
        //Recibimos el idingreso
    $id=$_GET['id'];
    
    $rspta = $venta->listarDetalle($id);
    $total=0;
    echo'<thead style="">
    <th>Opciones</th>
    <th>Artículo</th>
    <th>Cantidad</th>
    <th>Precio Venta</th>
    <th>Descuento</th>
    <th>Subtotal</th>
    </thead>';
    
    while ($reg = $rspta->fetch_object())
    {
        echo '<tr class="filas"><td></td><td>'.$reg->nombre.'</td><td>'.$reg->cantidad.'</td><td>'.$reg->precio_venta.'</td><td>'.$reg->descuento.'</td><td>'.$reg->subtotal.'</td></tr>';
        $total=$total+($reg->precio_venta*$reg->cantidad-$reg->descuento);
        $neto = $reg->neto;
        $iva = $reg->iva;
        $total_final = $reg->total_final;

    }
    echo '<tfoot>
    <th>TOTAL</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
    <h5 style="color:#ee1616" id="total">  $'.$total.'</h5><input type="hidden" name="total_venta" id="total_venta">
    </th> 
    </tfoot>';
    break;
    
    case 'listar':
    $rspta=$venta->listar();
        //Vamos a declarar un array
    $data= Array();
    while ($reg=$rspta->fetch_object()){
        $data[]=array(
            "0"=>($reg->estado=='Aceptado')?
            '<button class="btn btn-success btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button> '.
            '<a class="btn btn-info btn-xs" role="button" href="../reportes/tiket.php?id='.$reg->idventa.'">
                <i class="fa fa-cc"></i></a> '.
            '<button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button> '
            :
            '<button class="btn btn-success btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>',
            "1"=>$reg->fecha,
            "2"=>$reg->cliente,
            "3"=>$reg->usuario,
            "4"=>$reg->num_comprobante,
            "5"=>$reg->total_venta,
            "6"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
            '<span class="label bg-red">Anulado</span>'
        );
    }
    $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
    echo json_encode($results);
    
    break;
    
    case 'selectCliente':
    require_once "../model/Persona.php";
    $persona = new Persona();
    
    $rspta = $persona->listarc();
    
    while ($reg = $rspta->fetch_object())
    {
        echo '<option value=' . $reg->idpersona . '>' . $reg->nombre.'  '.$reg->apellido .'  '.
        '('.$reg->num_documento.')'.  '</option>';
    }
    break;
    
    case 'listarArticulosVenta':
    require_once "../model/Articulo.php";
    $articulo=new Articulo();
    
    $rspta=$articulo->listarActivosVenta();
        //Vamos a declarar un array
    $data= Array();
    
    while ($reg=$rspta->fetch_object()){
        $data[]=array(
            "0"=>'<button class="btn btn-success btn-xs" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\',\''.$reg->precio_venta.'\')"><span class="fa fa-shopping-cart"></span></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->codigo,
            "3"=>$reg->stock,
            "4"=>$reg->precio_venta,
            "5"=>"<img src='../files/articulo/".$reg->imagen."' height='50px' width='50px' >"
        );
    }
    $results = array(
            "sEcho"=>1, //Información para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros al datatable
            "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
    echo json_encode($results);
    break;
}
}else {
header("HTTP/1.0 403 Forbidden");
exit;
}
?>