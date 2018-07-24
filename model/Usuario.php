<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($identi,$nombre,$apellido,$direccion,$telefono,$cargo,$correo,$clave,$imagen)
	{
		$sql="INSERT INTO usuario (identi,nombre,apellido,direccion,telefono,cargo,correo,clave,condicion,imagen)
		VALUES ('$identi','$nombre','$apellido','$direccion','$telefono','$cargo','$correo','$clave','1','$imagen')";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para editar registros
	public function editar($idusuario,$identi,$nombre,$apellido,$direccion,$telefono,$cargo,$correo,$clave,$imagen)
	{
		$sql="UPDATE usuario SET idusuario='$idusuario',identi='$identi',nombre='$nombre',apellido='$apellido',direccion='$direccion',
		telefono='$telefono',correo='$correo',clave='$clave',cargo='$cargo',correo='$correo',clave='$clave',
		imagen='$imagen' 
		WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar registros
	public function eliminar($idusuario)
	{
		$sql="DELETE FROM usuario  WHERE idusuario='$idusuario'";
		return ejecutarConsulta($sql);
	}


	//Implementamos un método para desactivar registros
	public function bloquear($idusuario,$condicion)
	{
       if ($condicion==1) {
		$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
       }else{
		$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
	
       }
      	return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idusuario)
	{
		$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario ";
		return ejecutarConsulta($sql);		
	}

	 public function verificar($login,$clave)
    {
        $sql="SELECT idusuario,nombre,identi,telefono,correo,cargo,imagen FROM usuario WHERE correo='$login' AND clave='$clave' AND condicion='1'"; 
        return ejecutarConsulta($sql);  
    }

}

?>