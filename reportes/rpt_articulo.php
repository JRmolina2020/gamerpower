<?php 
include'../config/conexion.php'; 
require('PDF_MC_table.php');
if (!isset($_SESSION['correo'])) {
//si no existe la session correo no dejara entrar y direcciona al usuario login form  
header('location:../');
}

//Instanciamos la clase para generar el documento pdf
$pdf=new PDF_MC_Table();
 
//Agregamos la primera página al documento pdf
$pdf->AddPage();
 
//Seteamos el inicio del margen superior en 25 pixeles 
$y_axis_initial = 25;
 
//Seteamos el tipo de letra y creamos el título de la página. No es un encabezado no se repetirá
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,6,'',0,0,'C');
$pdf->Cell(100,29,'LISTA DE ARTICULOS',0,0,'C'); 
$pdf->Image('../files/yambelu.png' , 80 ,3, 40 , 13,'PNG', 'http://www.desarrolloweb.com');
$pdf->Ln(20);
 
//Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
$pdf->SetFillColor(255,153,51); 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(50,10,'Nombre',0,0,'C',1); 
$pdf->Cell(50,10,utf8_decode('Categoría'),0,0,'C',1);
$pdf->Cell(50,10,utf8_decode('Código'),0,0,'C',1);
$pdf->Cell(44,10,'Stock',0,0,'C',1);
$pdf->Ln(13);
 
//Comenzamos a crear las filas de los registros según la consulta mysql
require_once "../model/Articulo.php";
$articulo = new Articulo();
$rspta = $articulo->listar();
//Implementamos las celdas de la tabla con los registros a mostrar
$pdf->SetWidths(array(50,50,50,44));
while($reg= $rspta->fetch_object())
{  
    $nombre = $reg->nombre;
     $categoria = $reg->categoria;
    $codigo = $reg->codigo;
    $stock = $reg->stock;
    $descripcion =$reg->descripcion;
    $imagen =$reg->imagen;
      $pdf->SetFont('Arial','',10);
      $pdf->SetDrawColor(255,255,255);
       $pdf->SetLineWidth(.3);
      $pdf->SetAligns(array('C','C','C','C','C'));
    $pdf->Row(array(utf8_decode($nombre),$categoria,$codigo,$stock));

}

//Mostramos el documento pdf
$pdf->Output();
ob_end_flush();
?>