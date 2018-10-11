<?php
require 'header.php';
require_once'../controller/home.php';
?>
<div class="content-wrapper">
  <section class="content">
   <div class="row">
     <div class="panel-body table-responsive" id="divlistado">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Reportes</h3>
        </div>
        <div class="box-body">
            <!-- reportes -->
            <div class="col-lg-6">
            <h5>Reportes del almacen</h5>
          <table class="table table-bordered">
            <!-- llamado de variables -->
            <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>1</td>
               <td>Productos agotados</td>
                <td><a href="../reportes/productos_agotados.php" type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</a></td>
            </tr>
            <tr>
              <td>2</td>
               <td>Productos apunto de agotarse</td>
                <td><a href="../reportes/productos_apunto.php" type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
             <tr>
              <td>3</td>
               <td>Ventas rechazadas en el dia</td>
              <td><a href="../reportes/ventas_rechazadas.php" type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
             <tr>
              <td>4</td>
               <td>Ventas rechazadas en la semana</td>
                <td><button type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
            </tbody>
          </table>
          </div>
          <div class="col-lg-6">
            <p>Reporte de ventas por rango de fecha </p><br>
            <form method="GET" action="../reportes/rango.php">
            <div class="form-group col-lg-6 col-md-3 col-sm-12 col-xs-12">
              <label>Fecha Inicio</label>
             <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">
              </div>
             <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
             <label>Fecha Fin</label>
            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" >
            </div>
            <div class="col-lg-2">
              <label>Consultar</label>
            <button type="submit" class="btn btn-block btn-flat btn-primary btn-md">
              <i class="fa fa-search"></i>
            </button>
          </div>
          </div>
          </form>
            <!-- end -->
      </div>
    </div>
  </div>
  </div>
</section>
</div>
<?php
require 'footer.php';
?>






