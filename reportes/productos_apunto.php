<?php 
  use Dompdf\Dompdf;
  require_once('../public/dompdf/autoload.inc.php');
  require_once "../model/Consultas.php";
  if(isset($_SESSION["correo"]))
  {
  $consultas = new Consultas();
  $rspta = $consultas->productos_apunto();
  //Criando a Instancia
  $dompdf = new DOMPDF();
  $data= Array();
 $html='
 <link rel="stylesheet" href="../public/dompdf/plantilla.css">
<center>
 <img src="../public/images/logo.png" heigth="100" width="100">
 </center>
 <h5>PRODUCTOS APUNTO DE AGOTARSE</h5>
 <table>
   <thead>
     <tr>
       <th>Nombre</th>
       <th>Cantidad</th>
     </tr>
   </thead>
   <tbody>';
    while ($reg=$rspta->fetch_object()){
    $nombre = $reg->nombre;
     $cantidad = $reg->cantidad;
     $imagen=$reg->imagen;
   $html.='  
     <tr>
       <td>'.$nombre.'</td>
       <td>'.$cantidad.'</td>
      <td><img src="../files/articulo/'.$imagen.'" width=30 heigth=30></td>';
  
      
  $html.='</tr>';
     }
 $html.='</tbody></table>';
  $dompdf->load_html($html);
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
    "productos_apunto_de_agotarze.pdf", 
    array(
      "Attachment" => false //Para realizar o download somente alterar para true
    )
  );
  }else{
header('location:../');
}
?>

