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
       </div>
      </div>
    </div>
  </div>
          <!-- PRODUCT LIST -->
          <div class="row">
            <div class="col-lg-8"></div>
            <div class="col-lg-4">
               <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nuevos productos</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
           <?php
           while ($regA=$rsptaA->fetch_object()){
           $nombrex = $regA->nombre;
            $descrix = $regA->descripcion;
            $preciox = $regA->precio_venta;
            $imagenx = $regA->imagen;
           ?>
                <li class="item">
                  <div class="product-img">
                  <?php echo"<img src='../files/articulo/".$imagenx."'>";?>
                  </div>
                  <div class="product-info">
                    <a href="javascript:void(0)" class="product-title"><?php echo $nombrex ?>
                      <span class="label label-warning pull-right"><?php echo $preciox; ?></span></a>
                    <span class="product-description">
                          <?php echo $descrix; ?>
                        </span>
                  </div>
                </li>
                <?php }?>

              </ul>
            </div>
            <div class="box-footer text-center">
              <a href="Articulo.php" class="uppercase">Ver todos los productos</a>
            </div>
          </div>
              
            </div>
          </div>
          
          <!-- END CARD LIST PRODUCTOS -->
        
</section>
</div>
<script type="text/javascript" src="../public/js/Chart.min.js"></script>
<script type="text/javascript" src="../public/js/Chart.bundle.min.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById("compras").getContext('2d');
  var compras = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?php echo $fechasc; ?>],
      datasets: [{
        label: '# Compras en S/ de los últimos 10 días',
        data: [<?php echo $totalesc; ?>],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
  var ctx = document.getElementById("ventas").getContext('2d');
  var ventas = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [<?php echo $fechasv; ?>],
      datasets: [{
        label: '# Ventas en S/ de los últimos 12 meses',
        data: [<?php echo $totalesv; ?>],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)',
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script> 
<?php
require 'footer.php';
?>






