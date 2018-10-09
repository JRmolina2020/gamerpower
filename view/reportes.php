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
               <td>Productos agotados en el dia</td>
                <td><button type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
            <tr>
              <td>2</td>
               <td>Productos apunto de agotarse</td>
                <td><button type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
             <tr>
              <td>3</td>
               <td>Ventas rechazadas en el dia</td>
              <td><button type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
             <tr>
              <td>4</td>
               <td>Ventas rechazadas en la semana</td>
                <td><button type="button" class="btn btn-block btn-xs btn-primary btn-flat">Click</button></td>
            </tr>
            </tbody>
          </table>
          </div>
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






