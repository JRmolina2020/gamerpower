<?php 

  //referenciar o DomPDF com namespace
  use Dompdf\Dompdf;

  // include autoloader
  require_once("dompdf/autoload.inc.php");
  require_once "../model/Cliente.php";
  $cliente = new Cliente();
  $rspta = $cliente->listar();

  //Criando a Instancia
  $dompdf = new DOMPDF();
  $data= Array();

 $html='
 <table border="1">
   <thead>
     <tr>
       <th>nombre</th>
     </tr>
   </thead>';

    while ($reg=$rspta->fetch_object()){
    $data[]=array(
   $html2='     
   <tbody>
     <tr>
       <td>'.$reg->cedula.'</td>
     </tr>
   </tbody>'
   );
}

 $html3='</table>
';

  $dompdf->load_html($html.$html2.$html3);
  //Renderizar o html
  $dompdf->render();

  //Exibibir a página
  $dompdf->stream(
    "relatorio_celke.pdf", 
    array(
      "Attachment" => false //Para realizar o download somente alterar para true
    )
  );
?>