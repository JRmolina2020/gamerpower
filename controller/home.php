<?php
require_once "../model/Consultas.php";
 require_once"../model/Articulo.php";
$consulta = new Consultas();

  // mostrar el total de las comprar en el dia actual
$rsptac = $consulta->totalcomprahoy();
$regc=$rsptac->fetch_object();
$totalc=$regc->total_final;
 // mostrar total de ventas realizadas en el dia actual
$rsptav = $consulta->totalventahoy();
$regv=$rsptav->fetch_object();
$totalv=$regv->total_final;
// mostrar el numero de facturas de ventas emitidas en un dia
$rsptaf = $consulta->facturasventas_dia_actual();
$regf=$rsptaf->fetch_object();
$totalf=$regf->totalf;

// mostrar el numero de compras  emitidas en un dia
$rsptai = $consulta->facturascompras_dia_actual();
$regi=$rsptai->fetch_object();
$totali=$regi->totali;

// mostrar el numero total de clientes en el sistema
$rsptacli = $consulta->total_clientes();
$regcli=$rsptacli->fetch_object();
$sumcli=$regcli->sumcli;
// total de proveedores registrados en el sistemas
$rsptap = $consulta->total_provedores();
$regp=$rsptap->fetch_object();
$sump=$regp->sump;
   //Datos para mostrar el gráfico de barras de las compras
$compras10 = $consulta->comprasultimos_10dias();
$fechasc='';
$totalesc='';
while ($regfechac= $compras10->fetch_object()) {
  $fechasc=$fechasc.'"'.$regfechac->fecha .'",';
  $totalesc=$totalesc.$regfechac->total .','; 
}
  //Quitamos la última coma
$fechasc=substr($fechasc, 0, -1);
$totalesc=substr($totalesc, 0, -1);

//Datos para mostrar el gráfico de barras de las ventas
$ventas12 = $consulta->ventasultimos_12meses();
$fechasv='';
$totalesv='';
while ($regfechav= $ventas12->fetch_object()) {
  $fechasv=$fechasv.'"'.$regfechav->fecha .'",';
  $totalesv=$totalesv.$regfechav->total .','; 
}
  //Quitamos la última coma
$fechasv=substr($fechasv, 0, -1);
$totalesv=substr($totalesv, 0, -1);
// consulta de los  ultimos productos ingresados
	 $articulo=new Articulo();
		$rsptaA=$articulo->listardiez();
// los 5 productos mas vendidos en el almacen
    $rsptapm=$consulta->productos_mas_vendidos();
    $rsptapmx=$consulta->productos_mas_vendidos();
    // los 5 productos menos vendidos en el almacen
    $rsptamv=$consulta->productos_menos_vendidos();
     // Rendimiento de vendedor por dia
    $conma=$consulta->rendi_vende_diario();
     // Rendimiento de vendedor por semana
    $rendise=$consulta->rendi_vende_semana();
   

?>










