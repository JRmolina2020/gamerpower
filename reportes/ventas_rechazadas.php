<?php 
  use Dompdf\Dompdf;
  require_once('../public/dompdf/autoload.inc.php');
  require_once "../model/Consultas.php";
 

  $consultas = new Consultas();
  $rspta = $consultas->ventas_rechazadas();
  //Criando a Instancia
  $dompdf = new DOMPDF();
  $data= Array();

 $html='
 <link rel="stylesheet" href="../public/dompdf/plantilla.css">
<center>
 <img src="../public/images/logo.jpg" heigth="100" width="100">
 </center>
 <h5>VENTAS ANULADAS HOY</h5>
 <table>
   <thead>
     <tr>
     <th>Vendedor</th>
       <th>Fecha</th>
       <th>Codigo</th>
       <th>Monto</th>
       <th>Nombre</th>
        <th>Apellido</th>
     </tr>
   </thead>
   <tbody>';
    while ($reg=$rspta->fetch_object()){
      $nombreV = $reg->vendedorN;
      $apellidoV = $reg->vendedorA;
    $fecha = $reg->fecha_hora;
     $codigo = $reg->num_comprobante;
     $total =$reg->total_venta;
     $nombre =$reg->nombre;
       $apellido =$reg->apellido;
   $html.='  
     <tr>
     <td>'.$nombreV  . ' ' . $apellidoV.'</td>
       <td>'.$fecha.'</td>
          <td>'.$codigo.'</td>
             <td>'.$total.'</td>
                <td>'.$nombre.'</td>
                   <td>'.$apellido.'</td>
     </tr>';
     }
 $html.='</tbody></table>';
  $dompdf->load_html($html);
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
    "productos_agotados.pdf", 
    array(
      "Attachment" => false //Para realizar o download somente alterar para true
    )
  );
?>

