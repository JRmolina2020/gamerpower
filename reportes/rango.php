<?php
$fecha1=$_REQUEST["fecha_inicio"];
$fecha2=$_GET["fecha_fin"];

use Dompdf\Dompdf;
  require_once('../public/dompdf/autoload.inc.php');
  require_once "../model/Consultas.php";
  $consultas = new Consultas();
  $rspta = $consultas->ventasfechacliente($fecha1,$fecha2);
  $rspta2 = $consultas->sumaventafecha($fecha1,$fecha2);

  $dompdf = new DOMPDF();
  $data= Array();
 $html='
 <link rel="stylesheet" href="../public/dompdf/plantilla.css">
<center>
 <img src="../public/images/logo.PNG" heigth="100" width="100">
 </center>
 <h5>VENTAS DE RANGO</h5>
 <table>
   <thead>
     <tr>
       <th>Fecha</th>
       <th>Vendedor</th>
       <th>Cliente</th>
       <th>#venta</th>
       <th>Total</th>
     </tr>
   </thead>
   <tbody>';
    while ($reg=$rspta->fetch_object()){
    $fecha = $reg->fecha;
     $vendedor = $reg->vendedor;
     $cliente =$reg->cliente;
     $apellidoV =$reg->apellidoV;
     $apellidoC =$reg->apellidoC;
     $numero = $reg->numero;
     $total= $reg->total;
   $html.='  
     <tr>
       <td>'.$fecha.'</td>
       <td>'.$vendedor.' '.$apellidoV.'</td>
       <td>'.$cliente .' '.$apellidoC .'</td>
       <td>'.$numero.'</td>
       <td>'.$total.'</td>
     </tr>
     ';
     }
 $html.=
 '</tbody></table>
 <table  style="width: 15px">
 <tr>
 <th bgcolor="#fff">TOTAL</th>
 </tr>
 </thead>
  <tbody>
  ';
    while ($reg2=$rspta2->fetch_object()){
    $suma = $reg2->total;	
   $html.='
   <tr>
   <td>'.$suma.'</td>
   </tr>
   </tbody>';
}
  $html.='</table>';
  $dompdf->load_html($html);
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
    "ventas_de_rango.pdf", 
    array(
      "Attachment" => false
    )
  );





?>