<?php 
require_once "../model/usuario.php";
$usuario=new Usuario();
$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$identi=isset($_POST["identi"])? limpiarCadena($_POST["identi"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
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
				move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuario/" . $imagen);
			}
		}
		$clave2=md5(sha1($clave));

		if (empty($idusuario)){
			$rspta=$usuario->insertar($identi,$nombre,$apellido,$direccion,$telefono,$cargo,$correo,$clave2,$imagen);
			echo $rspta ? "usuario registrado" : "Usuario no se pudo registrar";
		}
		else {
			$rspta=$usuario->editar($idusuario,$identi,$nombre,$apellido,$direccion,$telefono,$cargo,$correo,$clave2,$imagen);
			echo $rspta ? " usuario actualizado" : "usuario no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$usuario->eliminar($idusuario);
 		echo $rspta ? "usuario eliminado" : "usuario no se puede eliminar";
 		break;
	break;

	case 'bloquear':
	    $condicion = $_POST["condicion"];
		$rspta=$usuario->bloquear($idusuario ,$condicion);

 		echo $rspta ? "usuario desactivado" : "usuario no se pudo desactivar";
 		break;
	break;


	case 'mostrar':
		$rspta=$usuario->mostrar($idusuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	case 'listar':
		$rspta=$usuario->listar();
 		//Vamos a declarar un array
 		$data= Array();
	 		while ($reg=$rspta->fetch_object()){
	 			$data[]=array(
	 				"0"=>
	 				'<button class="btn btn-success btn-xs" onclick="mostrar('.$reg->idusuario.')">
	 				<i class="fa fa-pencil"></i></button>'.
	                ' <button class="btn btn-danger btn-xs"  onclick="eliminar('.$reg->idusuario.')">
	                <i class="fa fa-trash"></i></button>',
	 				"1"=>$reg->identi,
	 				"2"=>$reg->nombre,
	 				"3"=>$reg->apellido,
	 				"4"=>$reg->direccion,
	 				"5"=>$reg->telefono,
	 				"6"=>$reg->cargo,
	 				"7"=>$reg->correo,
	 			    "8"=>"<img src='../files/usuario/".$reg->imagen."' height='50px' width='50px' >",
	 			    "9"=>($reg->condicion==1)?
	 			        '<span onclick="bloquear('.$reg->idusuario.','.$reg->condicion.')"class="label label-success">Activo</span>':
	 			        '<span onclick="bloquear('.$reg->idusuario.','.$reg->condicion.')"class="label label-danger">bloqueado</span>'
	 				);

	 			} 
		 		$results = array(
		 			"sEcho"=>1, //Información para el datatables
		 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
		 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
		 			"aaData"=>$data);
		 		echo json_encode($results);

	break;

	case 'verificar':
        $logina=$_POST['logina'];
        $clavea=$_POST['clavea'];
 
        //Hash SHA256 en la contraseña
        $clavehash=md5(sha1($clavea));
 
        $rspta=$usuario->verificar($logina, $clavehash);
 
        $fetch=$rspta->fetch_object();
 
        if (isset($fetch))
        {
            //Declaramos las variables de sesión
            $_SESSION['idusuario']=$fetch->idusuario;
            $_SESSION['nombre']=$fetch->nombre;
            $_SESSION['correo']=$fetch->correo;
            $_SESSION['cargo']=$fetch->cargo;
             $_SESSION['imagen']=$fetch->imagen;
        }
        
 
echo json_encode($fetch);
break;

case 'salir':
        //Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
 
    break;

exit;
}
?>