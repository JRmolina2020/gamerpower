<?php
require 'header.php';
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <a class="btn btn-primary" data-toggle="modal" href='#modalcategoria'>Agregar</a>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="divlistadocategoria">
            <table id="listadocategoria" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Disponibilidad</th>
              </thead>
              <tbody>                            
              </tbody>
            </table>
          </div>
          <!-- INICIO MODAL -->
         <div class="modal fade" id="modalcategoria" data-backdrop="static" data-keyboard="false" data-keyboard=”false” tabindex=”-1″  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role=”dialog”>
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <!-- INICIO FORMULARIO -->
                  <form name="formulariocategoria" id="formulariocategoria" method="POST">
                    <div class="row"> 
                    <div class="col-lg-6">
                     <div class="form-group">
                      <label>Nombre:</label>
                       <input type="hidden" name="idcategoria" id="idcategoria">
                       <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la categoria" >
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                     <div class="form-group">
                  <label>Descripcion:</label>
                  <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion de la categoria" >
                </div>
                  </div>
                </div>
                <!-- TERMINO FORMULARIO -->
              </div>
              <div class="modal-footer">
         <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-md ">
          <span class="fa fa-save" aria-hidden="true"></span>
        </button>
        <button type="button" onclick="cerrarformulariocategoria()" class="btn btn-danger btn-md" data-dismiss="modal">
           <span class="fa fa-close" aria-hidden="true"></span>
        </button>
      </div>
          </div>
        </div>
      </div>

      <!-- END MODAL -->
      <!--Fin centro -->
             </div><!-- /.panel FIN
                -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!--Fin-Contenido-->
        <?php
        require 'footer.php';
        ?>
        <script type="text/javascript" src="scripts/categoria.js"></script>
      
        
         

