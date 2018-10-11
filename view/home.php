<?php
require 'header.php';
require_once'../controller/home.php';
?>
<script src="../public/js/highcharts.js"></script>
<script src="../public/js/exporting.js"></script>
<script src="../public/js/highcharts-3d.js"></script>
<script src="../public/js/export-data.js"></script>

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
  
          <br><br>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div id="container" style="height: 400px"></div>
         </div>

         
       </div>
      </div>
    </div>
  </div>    
</section>
</div>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'LOS 5 PRODUCTOS MAS VENDIDOS'
    },
    subtitle: {
        text: 'AÑO 2018'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
      categories:[
        <?php
           while ($rsmv=$rsptapm->fetch_object()){
           $producto = $rsmv->producto;?>
             '<?php echo $producto;?>',
             <?php } ?>
      ]
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Ventas',
        data: [
        <?php
           while ($rsmvs=$rsptapmx->fetch_object()){
           $comprado = $rsmvs->comprado;?>
             <?php echo $comprado;?>,
             <?php } ?>
        ]
    }]
});
    </script>
<?php
require 'footer.php';
?>






