<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
 
Class Consultas
{
    //Implementamos nuestro constructor
    public function __construct()
    {
 
    }
 
    
    public function ventasfechacliente($fecha_inicio,$fecha_fin,$idcliente)
    {
        $sql="SELECT DATE(v.fecha_hora) as fecha,u.nombre as usuario, p.nombre as cliente,v.num_comprobante,v.total_venta,
        v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE DATE(v.fecha_hora)>='$fecha_inicio' AND DATE(v.fecha_hora)<='$fecha_fin' AND v.idcliente='$idcliente'";
        return ejecutarConsulta($sql);      
    }
 
    public function totalcomprahoy()
    {
        $sql="SELECT IFNULL(SUM(total_final),0) as total_final FROM ingreso WHERE DATE(fecha_hora)=curdate()";
        return ejecutarConsulta($sql);
    }
 
    public function totalventahoy()
    {
        $sql="SELECT IFNULL(SUM(total_final),0) as total_final FROM venta WHERE DATE(fecha_hora)=curdate()";
        return ejecutarConsulta($sql);
    }

     public function comprasultimos_10dias()
    {
        $sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra) as total FROM ingreso GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,10";
        return ejecutarConsulta($sql);
    }
 
    public function ventasultimos_12meses()
    {
        $sql="SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,SUM(total_venta) as total FROM venta GROUP by MONTH(fecha_hora) ORDER BY fecha_hora DESC limit 0,10";
        return ejecutarConsulta($sql);
    }
}
 