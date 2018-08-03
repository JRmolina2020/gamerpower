<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";
 
Class Venta
{
    //Implementamos nuestro constructor
    public function __construct()
    {
 
    }
    //Implementamos un método para insertar registros
    public function insertar($idcliente,$idusuario,$num_comprobante,$fecha_hora,$total_venta,
        $idarticulo,$cantidad,$precio_venta,$descuento)
    {
        $sql="INSERT INTO venta (idcliente,idusuario,num_comprobante,fecha_hora,total_venta,
        estado)
        VALUES ('$idcliente','$idusuario','$num_comprobante','$fecha_hora','$total_venta','Aceptado')";
        //return ejecutarConsulta($sql);
        $idventanew=ejecutarConsulta_retornarID($sql);
 
        $num_elementos=0;
        $sw=true;
 
        while ($num_elementos < count($idarticulo))
        {
            $sql_detalle = "INSERT INTO detalle_venta(idventa, idarticulo,cantidad,precio_venta,descuento) VALUES ('$idventanew', '$idarticulo[$num_elementos]','$cantidad[$num_elementos]','$precio_venta[$num_elementos]','$descuento[$num_elementos]')";
            ejecutarConsulta($sql_detalle) or $sw = false;
            $num_elementos=$num_elementos + 1;
        }
 
        return $sw;
    }
 
     
    //Implementamos un método para anular la venta
    public function anular($idventa)
    {
        $sql="UPDATE venta SET estado='Anulado' WHERE idventa='$idventa'";
        return ejecutarConsulta($sql);
    }
 
 
    //Implementar un método para mostrar los datos de un registro a modificar
    public function mostrar($idventa)
    {
        $sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,
        v.num_comprobante,v.total_venta,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
        return ejecutarConsultaSimpleFila($sql);
    }
 
    public function listarDetalle($idventa)
    {
        $sql="SELECT dv.idventa,dv.idarticulo,a.nombre,dv.cantidad,dv.precio_venta,dv.descuento,
        (dv.cantidad*dv.precio_venta-dv.descuento) as subtotal  FROM detalle_venta dv inner join articulo a on dv.idarticulo=a.idarticulo 
        inner join venta v on v.idventa = dv.idventa
        where dv.idventa='$idventa'";
        return ejecutarConsulta($sql);
    }
 
    //Implementar un método para listar los registros
    public function listar()
    {
        $sql="SELECT v.idventa,DATE(v.fecha_hora) as fecha,v.idcliente,p.nombre as cliente,u.idusuario,u.nombre as usuario,v.num_comprobante,v.total_venta,v.estado FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario ORDER by v.idventa desc";
        return ejecutarConsulta($sql);      
    }
     
    // tiket venta cabezera
     public function ventacabecera($idventa)
    {
        $sql="SELECT v.idventa, v.fecha_hora as fecha,c.nombre,c.apellido,c.tipo_documento,c.num_documento,v.num_comprobante,
        v.total_venta
        FROM persona c 
        inner join venta v 
        on v.idcliente = c.idpersona where v.idventa='$idventa'";
        return ejecutarConsulta($sql);      
    }

    // tiket detalle
     public function ventadetalle($idventa)
    {
        $sql="
        SELECT vd.cantidad as cantidad,a.nombre as articulo,vd.cantidad*vd.precio_venta as subtotal,vd.descuento
            FROM detalle_venta vd 
            INNER JOIN venta v
            ON v.idventa = vd.idventa
            INNER JOIN articulo a
            ON a.idarticulo = vd.idarticulo
            WHERE vd.idventa ='$idventa'";
            return ejecutarConsulta($sql);      
    }

}
?>