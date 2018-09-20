<?php 
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
require_once "../model/Articulo.php";
$articulo=new Articulo();
$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$condicion=isset($_POST["condicion"])? limpiarCadena($_POST["condicion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
		{
			$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["imagen"]["name"]);
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/articulo/" . $imagen);
			}
		}
		if (empty($idarticulo)){
			$rspta=$articulo->insertar($idcategoria,$codigo,$nombre,$descripcion,$imagen,$condicion);
			echo $rspta ? "Artículo registrado" : "Artículo no se pudo registrar";
		}
		else {
			$rspta=$articulo->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen,$condicion);
			echo $rspta ? "Artículo actualizado" : "Artículo no se pudo actualizar";
		}
	break;

	
	case 'eliminar':
	$rspta=$articulo->eliminar($idarticulo);
	echo $rspta ? "Artículo eliminado" : "Artículo no se puede eliminar";
	break;

	case 'mostrar':
	$rspta=$articulo->mostrar($idarticulo);
 	echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$articulo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>
 				'<button type="button" class="btn btn-success btn-flat margin btn-xs" onclick="mostrar('.$reg->idarticulo.')">
 				<i class="fa fa-pencil"></i></button>'.
 				'<button type="button" class="btn btn-danger btn-flat margin  btn-xs" onclick="eliminar('.$reg->idarticulo.')">
 				<i class="fa fa-trash"></i></button>',
 				"1"=>$reg->categoria,
 				"2"=>$reg->codigo,
 				"3"=>$reg->nombre,
 				"4"=>($reg->stock =="0")?'<span class="label bg-red">Agostado</span>':
 				$reg->stock
 				,
 				"5"=>$reg->descripcion,
 				"6"=>"<img src='../files/articulo/".$reg->imagen."' height='50px' width='50px' >",
 				"7"=>($reg->condicion)?
 				'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red" >Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case "selectCategoria":
		require_once "../model/Categoria.php";
		$categoria = new Categoria();

		$rspta = $categoria->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcategoria . '>' . $reg->nombre . '</option>';
				}
	break;
}
}else {
header("HTTP/1.0 403 Forbidden");
exit;
}
?>