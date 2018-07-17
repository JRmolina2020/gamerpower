<?php 


require_once "../model/Venta.php";

$venta=new Venta();
$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$idusuario=$_SESSION["idusuario"];
$num_comprobante=isset($_POST["num_comprobante"])? limpiarCadena($_POST["num_comprobante"]):"";
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";
$total_venta=isset($_POST["total_venta"])? limpiarCadena($_POST["total_venta"]):"";
$neto=isset($_POST["total_neto"])? limpiarCadena($_POST["total_neto"]):"";
$iva=isset($_POST["total_iva"])? limpiarCadena($_POST["total_iva"]):"";
$total_final=isset($_POST["total_cfinal"])? limpiarCadena($_POST["total_cfinal"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':
    if (empty($idventa)){
        $rspta=$venta->insertar($idcliente,$idusuario,$num_comprobante,$fecha_hora,$total_venta,
        $neto, $iva,$total_final,
            $_POST["idarticulo"],$_POST["cantidad"],$_POST["precio_venta"],$_POST["descuento"]);
        echo $rspta ? "Venta registrada" : "No se pudieron registrar todos los datos de la venta";
    }
    else {
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
    echo '<thead style="">
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
   <th>
  TOTAL<br>
  $NETO<br>
  IVA 18%<br>
  TOTAL COMPRA</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
    <h5 id="total">$/.'.$total.'</h5><input type="hidden" name="total_venta" id="total_venta">
    <h5 id="neto">S/.'.$neto.'</h4><input type="hidden" name="total_neto" id="total_neto">
    <h5 id="iva">S/.'.$iva.'</h4><input type="hidden" name="total_iva" id="total_iva">
    <h5 id="total_final">S/.'.$total_final.'</h4><input type="hidden" name="total_final" id="total_final>
    </th> 
    
    </tfoot>';
    break;
    
    case 'listar':
    $rspta=$venta->listar();
        //Vamos a declarar un array
    $data= Array();
    while ($reg=$rspta->fetch_object()){
        $data[]=array(
            "0"=>($reg->estado=='Aceptado')?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>'.
            ' <button class="btn btn-danger btn-xs" onclick="anular('.$reg->idventa.')"><i class="fa fa-close"></i></button>':
            '<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->idventa.')"><i class="fa fa-eye"></i></button>',
            "1"=>$reg->fecha,
            "2"=>$reg->cliente,
            "3"=>$reg->usuario,
            "4"=>$reg->num_comprobante,
            "5"=>$reg->total_venta,
            "6"=>$reg->neto,
            "7"=>$reg->iva,
            "8"=>$reg->total_final,
            "9"=>($reg->estado=='Aceptado')?'<span class="label bg-green">Aceptado</span>':
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
            "2"=>$reg->categoria,
            "3"=>$reg->codigo,
            "4"=>$reg->stock,
            "5"=>$reg->precio_venta,
            "6"=>"<img src='../files/articulo/".$reg->imagen."' height='50px' width='50px' >"
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
?>