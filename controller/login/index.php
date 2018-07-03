
  <?php
  include '../../config/conexion.php';
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $usuario = $conexion ->real_escape_string(htmlentities($_POST['usuario']));
  $contra = $conexion ->real_escape_string(htmlentities($_POST['contra']));
  $candado = ' ';
  $str_u = strpos($usuario, $candado);
  $str_p = strpos($contra, $candado);

  if (is_int($str_u)) {
  $usuario = '';
  }else{
  $usuario2 = $usuario;
  }
  if (is_int($str_p)) {
  $contra = '';
  }else{
  $contra2 = md5($contra);
  }
//usuario2 and contra2

  if ($usuario2 == null && $contra2 == null) {
  header('location:../extend/alerta.php?msj=El formato no es correcto&c=salir&p=salir&t=error');
  }else{
          $sel = $conexion  ->query("SELECT idusuario,identi,nombre,apellido,direccion,telefono,cargo,correo,clave,condicion,imagen FROM usuario 
            WHERE correo = '$usuario2' AND clave  = '$contra2' AND condicion = 1 ");
  $row = mysqli_num_rows($sel);

  if ($row == 1) {

      if($var = $sel-> fetch_assoc() ){
            $idusuario = $var['idusuario'];
            $identi = $var['identi'];
             $nombre = $var['nombre'];
              $apellido = $var['apellido'];
               $direccion = $var['direccion'];
                $telefono = $var['telefono'];
                 $cargo = $var['cargo'];
            $correo = $var['correo'];
            $clave = $var['clave'];
             $condicion = $var['condicion'];
             $imagen = $var['imagen'];
           
        }

  if($correo == $usuario2 && $clave  == $contra2 && $cargo == 'VENDEDOR'){
         $_SESSION["idusuario"] = $idusuario; 
        $_SESSION["correo"] = $correo;
        $_SESSION["nombre"] = $nombre;
        $_SESSION["cargo"] = $cargo;
        $_SESSION["condicion"] = $condicion;
        $_SESSION["imagen"] = $imagen;
        header('location:../../view/home.php');
  }
  elseif($correo == $usuario2 && $clave == $contra2 && $cargo == 'ADMIN'){
         $_SESSION["idusuario"] = $idusuario; 
        $_SESSION["correo"] = $correo;
        $_SESSION["nombre"] = $nombre;
        $_SESSION["cargo"] = $cargo;
        $_SESSION["condicion"] = $condicion;
        $_SESSION["imagen"] = $imagen;
        header('location:../../view/home.php');
  }
  
  else  {
  header('location:../../index.php');
  }
  }else
  {
  header('location:../../index.php');
  }
  }
  // cierra method
  }else{
  header('location:../');
  }
  ?>