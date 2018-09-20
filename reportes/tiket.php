<?php
require_once'../config/conexion.php';
if (isset($_SESSION["nombre"]))
{
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../public/css/ticket.css" rel="stylesheet" type="text/css">
</head>
<body onload="window.print();">
<?php
 
//Incluímos la clase Venta
require_once "../model/Venta.php";
//Instanaciamos a la clase con el objeto venta
$venta = new Venta();
//En el objeto $rspta Obtenemos los valores devueltos del método ventacabecera del modelo
$rspta = $venta->ventacabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
$reg = $rspta->fetch_object();
 
//Establecemos los datos de la empresa
$empresa = "Tienda de videojuegos GAMERS FLY";
$documento = "9281 DIAN";
$direccion = "GALERIA LOCAL #5,SEGUNDO PISO    ";
$telefono = "3006754499";
$email = "GAMER@GMAIL.COM";
?>
<div class="zona_impresion">
<!-- codigo imprimir -->
<br>
<table border="0" align="center" width="300px">
    <tr>
        <td align="center">
        <!-- Mostramos los datos de la empresa en el documento HTML -->
        :::<strong><?php echo $empresa; ?></strong>:::<br>
        <?php echo $documento; ?><br>
        <p><?php echo $direccion?></p>
        <p>TEL <?php echo $telefono?></p>
        </td>
    </tr>
    <tr>
        <td align="center"><?php echo $reg->fecha; ?></td>
    </tr>
    <tr>
      <td align="center"></td>
    </tr>
    <tr>
    <td>Cliente: <?php echo $reg->nombre;?></td>
    </tr>
    <tr>
    <td><?php echo $reg->tipo_documento.": ".$reg->num_documento; ?></td>
    </tr>
    <tr>
    <td>#VENTA:<?php echo $reg->num_comprobante;?></td>
    </tr>    
</table>
<br>
<!-- DETALLES DE LA VENTA -->
<!-- Mostramos los detalles de la venta en el documento HTML -->
<table border="0" align="center" width="350px">
    <tr>
        <td>CANT.</td>
        <td>DESCRIPCION</td>
        <td WIDTH="40"></td>
        <td align="right">IMPORTE</td>

    </tr>
    <tr>
      <td colspan="6">==================================================</td>
    </tr>
    <?php
    $rsptad = $venta->ventadetalle($_GET["id"]);
    $cantidad=0;
    while ($regd = $rsptad->fetch_object()) {
        echo "<tr>";
        echo "<td>".$regd->cantidad."</td>";
        echo "<td>".$regd->articulo;
        echo "<td>".$regd->descuento;
        echo "<td align='right'>$/ ".$regd->subtotal."</td>";
        echo "</tr>";
        $cantidad+=$regd->cantidad;
    }
    ?>
    <!-- Mostramos los totales de la venta en el documento HTML -->
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><b>TOTAL:$/<?php echo $reg->total_venta;?></b></td>
    </tr>
    <tr>
      <td colspan="3"># de artículos: <?php echo $cantidad; ?></td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>      
    <tr>
      <td colspan="6" align="center">¡Gracias por su compra!</td>
    </tr>
    <tr>
      <td colspan="6" align="center">GAMERS FLY</td>
    </tr>
    <tr>
    <td colspan="6" align="center">eeeeeeeeeeee
      eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee</td>
    </tr>
    <tr>
      <td colspan="6" align="center">VALLEDUPAR - COLOMBIA</td>
    </tr>
     
</table>
<!-- END -->
<br>
</div>
<p>&nbsp;</p>
 
</body>
</html>
<?php
}else{
header('location:../index.php');
}
?>