<?php
require 'header.php';
?>
<div class="content-wrapper">
  <!-- section articulos-->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
          <div class="panel-body">
            <!-- menu tab custom -->
            <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li><a href="#nuevox" onclick="mostrardivimagen()" data-toggle="tab">Nuevo</a></li>
                <li class="active"><a href="#listax" data-toggle="tab">Listado</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i>Articulos</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- listado -->
              <div class="chart tab-pane active" id="listax" style="position: relative;height: 100%;">
             <div class="panel-body table-responsive" id="divlistado">
            <table id="listado" class="table  table-bordered">
              <thead>
                <th>Opciones</th>
                <th>Categoria</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Existencias</th>
                 <th>Descripcion</th>
                 <th>Imagen</th>
                <th>Disponibilidad</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
            </div>
            <!-- end listado -->
            <!-- registro -->
              <div class="chart tab-pane" id="nuevox" style="position: relative; height: 100%;">
              <div class="panel-body">
             <!-- body form1-->
             <div class="col-lg-9">
            <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h5 class="box-title">Detalles del producto</h5>
              <div class="box-body">
                <!-- form -->
                  <form name="formulario" id="formulario" method="POST">
                    <input type="hidden" id="idarticulo" name="idarticulo">
                    <!-- start fila1 -->
                    <div class="row">
                     <!--input codigo  -->
                    <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                    <div class="form-group">
                   <label class="control-label">Codigo</label>
                    <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código Barras" autofocus>
                    </div>
                  </div>
                    <!-- input nombre -->
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                     <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre del articulo" >
                     </div>
                   </div>
                     <!-- input categoria -->
                     <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                       <div class="form-group">
                      <label class="control-label">Categoria</label>
                     <select id="idcategoria" name="idcategoria" class="form-control selectpicker"
                     data-live-search="true">
                   </select>
                     </div>
                   </div>
                   <!-- input cantidad -->
                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-12" id="divstock">
                     <div class="form-group">
                     <label class="control-label">Stock</label>
                     <input type="text" class="form-control"  name="stock" id="stock" >
                     </div>
                   </div>
                 </div>
                 <!-- end fila 1 -->
                 <!-- start fila2 -->
                 <div class="row">
                  <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                     <div class="form-group">
                     <label class="control-label">Presentaciòn</label>
                    <input type="file" onclick="ocultardivimagen()" class="form-control" name="imagen" id="imagen">
                     </div>
                   </div>
                   <div class="col-lg-6 col-md-6 col-xs-8 col-sm-8">
                     <div class="form-group">
                     <label class="control-label">Descripciòn</label>
                      <textarea name="descripcion" id="descripcion" class="form-control" rows="1" required="required"></textarea>
                     </div>
                   </div>
                   <div class="col-lg-2 col-md-2 col-xs-4 col-sm-4">
                    <div class="form-group">
                     <label class="control-label">Disponible</label>
                      <select name="condicion" id="condicion" class="form-control">
                        <option value="1">Si-D</option>
                        <option value="0">No-D</option>
                      </select>
                     </div> 
                   </div>
                 </div>
                 <!-- end fila2-->
                 <br><br>
              <!-- end box-body -->
              <div class="form-group">
                <button type="button" onclick="cerrarformulario()" class="btn btn-danger btn-flat margi pull-left">Cancelar</button>
                <button type="submit" class="btn btn-success pull-right btn-flat margi">Guardar</button>
              </div>
                <!-- end form -->
               </div>
             </div>
             </div>
           </div>
           <!-- end body form 1 -->
           <!-- body form2 -->
           <!-- CUADROS IMAGEN -->
           <div class="row">
           <div class="col-lg-3">
            <div class="box box-default" id="div-muestra">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <div id="cuadritoimagen" class="box-body">
                    <input type="hidden" name="imagenactual" id="imagenactual">
                    <center>
                    <img src="" width="78px" height="82px" id="imagenmuestra">
                   </center>
             </div>
             <!-- barcode -->
              <div id="print">
              <svg id="barcode">
               </svg>
                </div>
                <!-- end barcode -->
               </div>
             </div>
             </div>
             </div>
           </div>
            </form>
           <!-- end body form -->
          </div>
           <!-- end panel body -->
          <!-- end registro -->
        </div>
             </div>
              </div>

          </section>
        </div>

        <?php
        require 'footer.php';
        ?>
  <script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
  <script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
   <script type="text/javascript" src="scripts/articulo.js"></script>

 




