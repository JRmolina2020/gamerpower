<?php 
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
require_once "../model/cliente.php";
$cliente=new Cliente();
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$cedula=isset($_POST["cedula"])? limpiarCadena($_POST["cedula"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$ciudad=isset($_POST["ciudad"])? limpiarCadena($_POST["ciudad"]):"";
$barrio=isset($_POST["barrio"])? limpiarCadena($_POST["barrio"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
switch ($_GET["op"]){
	case 'guardaryeditar':

		// guardar registro
		if (empty($idcliente)){
			$rspta=$cliente->insertar($cedula,$nombre,$apellido,$telefono,$ciudad,$barrio,$direccion);
			echo $rspta ? "cliente registrado" : "Cliente no se pudo registrar";
		}
		else {
			$rspta=$cliente->editar($idcliente,$cedula,$nombre,$apellido,$telefono,$ciudad,$barrio,$direccion);
			echo $rspta ? " Cliente actualizado" : "Cliente no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$cliente->eliminar($idcliente);
 		echo $rspta ? "Cliente eliminado" : "Cliente no se puede eliminar, tiene mascotas asignada";
 		break;
	

	case 'mostrar':
		$rspta=$cliente->mostrar($idcliente);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	
	case 'listar':
		$rspta=$cliente->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($_SESSION['nivel']=='ADMIN')?
 				'<button class="btn btn-warning btn-xs" onclick="mostrarcliente('.$reg->idcliente.')">
 				<i class="fa fa-pencil"></i></button>'.
 				// eliminar cliente
                ' <button class="btn btn-danger btn-xs" onclick="eliminarcliente('.$reg->idcliente.')">
                <i class="fa fa-trash"></i></button>'.
                // direccionar a registro de mascota para ese cliente
                '<a class="btn btn-info btn-xs" role="button" href="../view/mascota.php?client='.$reg->idcliente.'">
                <i class="fa fa-paw"></i></a>'.
                // reporte de clientes
                '<a class="btn btn-success btn-xs" role="button" href="../reportes/rptclientes.php?client='.$reg->idcliente.'">
                <i class="fa  fa-newspaper-o"></i></a>':
                 // _________________________________________ELSE______________________________________________
                '<button class="btn btn-warning btn-xs" onclick="permiso()">
 				<i class="fa fa-pencil"></i></button> ' .

                ' <button class="btn btn-danger btn-xs" onclick="permiso()">
                <i class="fa fa-trash"></i></button> ' .

                // direccionar a registro de mascota para ese cliente parte del ASISTENTE

                ' <a class="btn btn-info btn-xs" role="button" href="../view/mascota.php?client='.$reg->idcliente.'">
                <i class="fa fa-paw"></i></a>'.

                //reporte de clientes parte del ASISTENTE

                '<a class="btn btn-success btn-xs" role="button" href="../reportes/rptclientes.php?client='.$reg->idcliente.'">
                <i class="fa fa-newspaper-o"></i></a>',
                // _________________________________________________________________________________________
 				"1"=>$reg->cedula,
 				"2"=>$reg->nombre,
 				"3"=>$reg->apellido,
 				"4"=>$reg->telefono,
 				"5"=>$reg->ciudad,
 				"6"=>$reg->barrio,
 				"7"=>$reg->direccion
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