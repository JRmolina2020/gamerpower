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
          <h3 class="box-title">Inicio</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <!-- CARD COMPRAS REALIZADAS EN UN DIA -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">COMPRAS HOY </span>
                  <span class="info-box-number"><?php echo $totalc; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $totali;?>%"></div>
                  </div>
                  <span class="progress-description">
                  Compras emitidas : <?php echo $totali;?>
                  </span>
                </div>
              </div>
            </div>
            <!-- END CARD COMPRAS -->
            <!-- CARD VENTAS REALIZADAS EN UN DIA-->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">VENTAS HOY</span>
                  <span class="info-box-number"><?php echo $totalv; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $totalf;?>%"></div>
                  </div>
                  <span class="progress-description">
                  Facturas emitidas : <?php echo $totalf;?>
                  </span>
                </div>
              </div>
            </div>
            <!-- END CARD VENTAS REALIZADAS EN UN DIA -->
            <!-- CARD CLIENTES -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">CLIENTES </span>
                  <span class="info-box-number"><?php echo $sumcli; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $sumcli;?>%"></div>
                  </div>
                  <span class="progress-description">
                  Clientes registrados : <?php echo $sumcli;?>
                  </span>
                </div>
              </div>
            </div>

            <!-- END -->
            <!-- CARD VENDEDOR -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">PROVEEDORES </span>
                  <span class="info-box-number"><?php echo $sump; ?></span>

                  <div class="progress">
                    <div class="progress-bar" style="width: <?php echo $sump;?>%"></div>
                  </div>
                  <span class="progress-description">
                  Proveedores registrados : <?php echo $sump;?>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- EMD CARD VENDEDOR-->
          <!-- end body panel -->
          <!-- los cinco producto mas vendidos -->
          <br><br>
         
       </div>
      </div>
    </div>
  </div>    
</section>
</div>
<script type="text/javascript" src="../public/js/Chart.min.js"></script>
<script type="text/javascript" src="../public/js/Chart.bundle.min.js"></script>
<?php
require 'footer.php';
?>






