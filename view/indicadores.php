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
          <h3 class="box-title">Indicadores</h3>
        </div>
        <div class="box-body">
             <div class="row">
            <div class="col-lg-6">
              <h5>Los 5 Productos mas vendidos</h5>
          <table class="table table-bordered">
            <!-- llamado de variables -->
            <thead>
            <tr>
              <th>Producto</th>
              <th>Vendidos</th>
              <th>$Total</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
           <?php
           while ($rsmv=$rsptapm->fetch_object()){
           $producto = $rsmv->producto;
            $comprado = $rsmv->comprado;
             $total = $rsmv->total;
            $imagen = $rsmv->imagen;
           ?>
            <tr>
              <td><?php echo $producto;?></td>
               <td><?php echo $comprado;?></td>
                <td><?php echo $total;?></td>
                <td><?php echo"<img src='../files/articulo/".$imagen."' width=30 heigth=30 >";?></td>
            </tr>
            <?php }?>
            </tbody>
          </table>
          </div>
          <!-- end los 5 productos mas vendidos -->
          <!-- los 5 productos menos vendidos -->
          <div class="col-lg-6">
              <h5>Los 5 Productos menos vendidos</h5>
          <table class="table table-bordered">
            <thead>
            <tr>
            <th>Producto</th>
            <th>Vendidos</th>
            <th>$Total</th>
             <th></th>
            </tr>
            </thead>
            <tbody>
           <?php
           while ($rsmev=$rsptamv->fetch_object()){
           $producto = $rsmev->producto;
            $comprado = $rsmev->comprado;
             $total = $rsmev->total;
             $imagen = $rsmev->imagen;
           ?>
            <tr>
            <td><?php echo $producto;?></td>
            <td><?php echo $comprado;?></td>
            <td><?php echo $total;?></td>
              <td><?php echo"<img src='../files/articulo/".$imagen."' width=30 heigth=30 >";?></td>
            </tr>
             <?php }?>
            </tbody>
          </table>
          </div>
          <!-- end los 5 productos menos vendidos -->
       </div>
       <div class="row">
        <div class="col-lg-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Seguimiento de vendedores Por dia</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Nombre</th>
                  <th>Apellido</th>
                  <th>Perfil</th>
                  <th>Progreso</th>
                  <th style="width: 40px">Art.Vendidos</th>
                </tr>
                <?php
               while ($conmaR=$conma->fetch_object()){
               $nombre = $conmaR->nombre;
                $apellido = $conmaR->apellido;
                $cantidad = $conmaR->cantidad;
                $imagen =$conmaR->imagen;
               ?>
                <tr>
                  <td><?php echo $nombre ?></td>
                  <td><?php echo $apellido;?></td>
                  <td><?php echo"<img src='../files/usuario/".$imagen."' width=30 heigth=30 >";?></td>
                  <td>
                    <div class="progress progress-md progress-striped active">
                      <?php 
                      if ($cantidad<=10){?>
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $cantidad;?>%"></div>
                      <?php }?>
                      <?php if ($cantidad>10 and $cantidad<=15){?>
                      <div class="progress-bar progress-bar-primary" style="width: <?php echo $cantidad;?>%"></div>
                      <?php }?>
                      <?php if ($cantidad>15){?>
                      <div class="progress-bar progress-bar-success" style="width: <?php echo $cantidad;?>%"></div>
                      <?php }?>
                    </div>
                  </td>
                  <td><span class="badge bg-default"><?php echo $cantidad; ?></span></td>
                  </tr>
                  <?php }?>
              </table>
            </div>
            </div>
          </div>
          </div>
           <div class="col-lg-6">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Seguimiento de vendedores Por semana</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 10px">Nombre</th>
                  <th>Apellido</th>
                  <th>Perfil</th>
                  <th>Progreso</th>
                  <th style="width: 40px">Art.Vendidos</th>
                </tr>
                <?php
               while ($rendi=$rendise->fetch_object()){
               $nombre = $rendi->nombre;
                $apellido = $rendi->apellido;
                $cantidad = $rendi->cantidad;
                $imagen =$rendi->imagen;
               ?>
                <tr>
                  <td><?php echo $nombre ?></td>
                  <td><?php echo $apellido;?></td>
                  <td><?php echo"<img src='../files/usuario/".$imagen."' width=30 heigth=30 >";?></td>
                  <td>
                    <div class="progress progress-md progress-striped active">
                      <?php 
                      if ($cantidad<=20){?>
                      <div class="progress-bar progress-bar-danger" style="width: <?php echo $cantidad;?>%"></div>
                      <?php }?>
                      <?php if ($cantidad>20 and $cantidad<=30){?>
                      <div class="progress-bar progress-bar-primary" style="width: <?php echo $cantidad;?>%"></div>
                      <?php }?>
                      <?php if ($cantidad>30){?>
                      <div class="progress-bar progress-bar-success" style="width: <?php echo $cantidad;?>%"></div>
                      <?php }?>
                    </div>
                  </td>
                  <td><span class="badge bg-default"><?php echo $cantidad; ?></span></td>
                  </tr>
                  <?php }?>
              </table>
            </div>
            </div>
          </div>
          </div>
       </div>
      </div>
    </div>
  </div>
  </div>
</section>
</div>
<?php
require 'footer.php';
?>






