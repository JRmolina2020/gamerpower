<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
 
Class Consultas
{
    //Implementamos nuestro constructor
    public function __construct()
    {
 
    }
 
    
    public function ventasfechacliente($fecha_inicio,$fecha_fin)
    {
        $sql="SELECT DATE(v.fecha_hora) as fecha,u.nombre as vendedor,u.apellido as apellidoV, 
        p.nombre as cliente,p.apellido as apellidoC,v.num_comprobante as numero ,v.total_venta as total,v.estado FROM venta v 
        INNER JOIN persona p ON v.idcliente=p.idpersona 
        INNER JOIN usuario u ON v.idusuario=u.idusuario 
        WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin' AND v.estado ='Aceptado'
        ORDER BY v.fecha_hora ASC";
        return ejecutarConsulta($sql);      
    }
// SUMA DEL RANGO
     public function sumaventafecha($fecha_inicio,$fecha_fin)
    {
        $sql="SELECT SUM(v.total_venta) as total FROM venta v 
        WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin' AND v.estado ='Aceptado'";
        return ejecutarConsulta($sql);      
    }

 
    // total de una las compras que se han realizados en el dia actual en el almacen
    public function totalcomprahoy()
    {
        $sql="SELECT IFNULL(SUM(total_compra),0) as total_final FROM ingreso 
        WHERE DATE(fecha_hora)=curdate()
         and estado ='Aceptado'";
        return ejecutarConsulta($sql);
    }
 
 // total de una las ventas que se han realizados en el dia actual en el almacen
    public function totalventahoy()
    {
        $sql="SELECT IFNULL(SUM(total_venta),0) as total_final FROM venta 
        WHERE DATE(fecha_hora)=curdate() 
        and estado ='Aceptado' ";
        return ejecutarConsulta($sql);
    }

     public function comprasultimos_10dias()
    {
        $sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra) as total FROM ingreso 
        GROUP BY fecha_hora
         ORDER BY fecha_hora DESC limit 0,10";
        return ejecutarConsulta($sql);
    }
    // consulta para establecer el total de factura emitidas en un dia

     public function facturasventas_dia_actual()
    {
        $sql="SELECT  IFNULL (count(idventa),0) as totalf FROM venta 
        WHERE DATE(fecha_hora)=curdate() ";
        return ejecutarConsulta($sql);
    }

    //total de compras o ingresos de un dia
  public function facturascompras_dia_actual()
    {
        $sql="SELECT  IFNULL (count(idingreso),0) as totali FROM ingreso 
        WHERE DATE(fecha_hora)=curdate() ";
        return ejecutarConsulta($sql);
    }
      
 // total de clientes registrados
  public function total_clientes()
    {
        $sql="SELECT  IFNULL (count(idpersona),0) as sumcli FROM persona 
        WHERE tipo_persona='cliente'";
        return ejecutarConsulta($sql);
    }

    // total de provedores registrados
     public function total_provedores()
    {
        $sql="SELECT  IFNULL (count(idpersona),0) as sump FROM persona 
        WHERE tipo_persona='provedor'";
        return ejecutarConsulta($sql);
    }

     // los 5 productos mas vendidos
     public function productos_mas_vendidos()
    {
        $sql="SELECT a.nombre as producto,a.imagen as imagen ,sum(d.cantidad) as comprado,sum(total_venta) as total FROM articulo a 
        INNER JOIN detalle_venta d on d.idarticulo= a.idarticulo 
        INNER JOIN venta v on v.idventa = d.idventa WHERE v.estado='Aceptado' 
        GROUP BY producto 
        ORDER BY comprado  DESC Limit 0,5";
        return ejecutarConsulta($sql);
    }
    // los 5 productos menos vendidos
      public function productos_menos_vendidos()
    {
        $sql="SELECT a.nombre as producto,a.imagen as imagen,sum(d.cantidad) as comprado,sum(total_venta) as total FROM articulo a 
        INNER JOIN detalle_venta d on d.idarticulo= a.idarticulo 
        INNER JOIN venta v on v.idventa = d.idventa WHERE v.estado='Aceptado' 
        GROUP BY producto 
        ORDER BY comprado ASC Limit 0,5";
        return ejecutarConsulta($sql);
    }
    // RENDIMIENTO DE VENDEDORES POR DIA 
      public function rendi_vende_diario()
    {
        $sql="SELECT u.nombre,u.apellido,u.imagen as imagen,SUM(d.cantidad) as cantidad  FROM usuario u
            INNER JOIN venta v ON v.idusuario = u.idusuario 
            INNER JOIN detalle_venta d ON d.idventa = v.idventa
            WHERE v.estado='Aceptado' AND DATE(fecha_hora)=curdate()
            GROUP BY u.nombre
            ORDER BY cantidad  DESC";
        return ejecutarConsulta($sql);
    }
    // RENDIMIENTO DE VENDEDORES POR SEMANA
      public function rendi_vende_semana()
    {
        $sql="SELECT u.nombre,u.apellido,u.imagen as imagen,SUM(d.cantidad) as cantidad  FROM usuario u
            INNER JOIN venta v ON v.idusuario = u.idusuario 
            INNER JOIN detalle_venta d ON d.idventa = v.idventa
            WHERE v.estado='Aceptado' AND DATE(fecha_hora)=curdate() <7
            GROUP BY u.nombre
            ORDER BY cantidad  DESC";
        return ejecutarConsulta($sql);
    }

    // PRODUCTOS AGOTADOS POR DIA
    public function productos_agotados()
    {
        $sql="SELECT  a.nombre as nombre,a.stock as cantidad,a.imagen as imagen FROM articulo a 
        WHERE a.stock =0;";
        return ejecutarConsulta($sql);
    }
     // PRODUCTOS APUNTO DE AGOTARZE
    public function productos_apunto()
    {
        $sql="SELECT  a.nombre as nombre,a.stock as cantidad,a.imagen as imagen FROM articulo a 
        WHERE a.stock >0 AND a.stock <=5";
        return ejecutarConsulta($sql);
    }

   //VENTAS RECHAZADAS HOY

    public function ventas_rechazadas()
    {
        $sql="SELECT U.nombre as vendedorN,u.apellido as vendedorA,V.fecha_hora,V.num_comprobante,V.total_venta,P.nombre,P.apellido FROM venta V
        INNER JOIN persona P on P.idpersona = V.idcliente 
        INNER JOIN usuario U on U.idusuario = v.idusuario
        WHERE V.estado='Anulado' AND V.fecha_hora =CURDATE()";
        return ejecutarConsulta($sql);
    }

    public function ventasultimos_12meses()
    {
        $sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,SUM(total_venta) as total 
        FROM venta GROUP BY MONTH(fecha_hora) 
        ORDER BY fecha_hora DESC limit 0,10";
        return ejecutarConsulta($sql);
    }



}
 