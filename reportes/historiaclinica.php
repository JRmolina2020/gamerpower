
<?php
$idexamen=$_GET["examen"];
echo $idexamen;



//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

// include autoloader
require_once("dompdf/autoload.inc.php");
require_once "../model/Examen.php";
$examen = new Examen();
$rspta = $examen->listarhistoria($idexamen);

//Criando a Instancia
$dompdf = new DOMPDF();
$data= Array();

while ($reg=$rspta->fetch_object()){
$data[]=array(

$html='
<link type="text/css" href="../public/css/pdf.css" rel="stylesheet"/>

<img class="imglogo" src="logo.png">
<div class="header">
<H3>VETERINARIA EL VALLE</H3>
<h5>Calle 34A #4e-32 mayales</h5>
<h5>TEL:594340</h5>
<H5>VETDELVALLE.COM.ES</H5>

</div>
<table border="0">
<thead>
<tr>
<th>Cedula</th>
<th>Nombre</th>
<th>Apellido</th>
<th>Telefono</th>
<th>Ciudad</th>
 <th>Barrio</th>
   <th>Direccion</th>
</tr>
</thead>
<tbody>
<tr>
<td>'.$reg->cedula.'</td>
<td>'.$reg->nombre.'</td>
<td>'.$reg->apellido.'</td>
<td>'.$reg->telefono.'</td>
<td>'.$reg->ciudad.'</td>
<td>'.$reg->barrio.'</td>
<td>'.$reg->direccion.'</td>
</tr>
</tbody>
</table>
<br><br><br>
<table border="0">
<thead>
<tr>
<th>Nombre</th>
<th>Especie</th>
<th>Sexo</th>
<th>Raza</th>
<th>Edad</th>
 <th>Procedencia</th>
   <th>Descripcion</th>
</tr>
</thead>

<tbody>
<tr>
<td>'.$reg->mascotax.'</td>
<td>'.$reg->categoria.'</td>
<td>'.$reg->sexo.'</td>
<td>'.$reg->raza.'</td>
<td>'.$reg->edad.'</td>
<td>'.$reg->procedencia.'</td>
<td>'.$reg->descripcion.'</td>
</tr>
</tbody>
</table>




'
);
}




$dompdf->load_html($html);
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