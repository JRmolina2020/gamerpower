<?php
require 'header.php';
?>
<div class="content-wrapper">        
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
           <div class="box-header with-border">
             <a class="btn btn-primary" data-toggle="modal" href='#modal'>Agregar</a>
            <div class="box-tools pull-right">
            </div>
          </div>
          <div class="panel-body table-responsive" id="divlistado">
            <table id="listado" class="table table-striped table-bordered table-condensed table-hover">
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
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false" data-keyboard=”false” tabindex=”-1″  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" role=”dialog”>
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      
      <div class="modal-body">
        <!-- INICIO DE FORMULARIO -->
       <form name="formulario" id="formulario" method="POST">
             <input type="hidden" id="idarticulo" name="idarticulo">
             <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
              <div class="form-group">
              <label>Código:</label>
              <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código Barras">
               <button class="btn btn-success btn-xs" type="button" onclick="generarbarcode()">Generar</button>
               <a href="#" data-toggle="tooltip" title="Inserte primero el codigo"></a>
              <button class="btn btn-info btn-xs" type="button" onclick="imprimir()">Imprimir</button>
            </div>      
               </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                  <div class="form-group">
                  <label>Nombre:</label>
                  <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre del articulo" >
                </div>
               </div>
             </div>
              <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                  <label>Existencias:</label>
                  <input type="text" class="form-control" name="stock" id="stock"  placeholder="Cantidad de articulos" >
                </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group">
                <label>Descripcion</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required="required"></textarea>
              </div>
               </div>
             </div>
              <div class="row">
                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                 <label>Categoría:</label>
                 <select id="idcategoria" name="idcategoria" class="form-control selectpicker"  data-live-search="true" 
                 data-style="btn-primary"></select>
                  </div>
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Imagen:</label>
                 <div class="form-group">
                     <input type="file" class="form-control" name="imagen" id="imagen">
                   </div>
               </div>
             </div>
<!-- cuadros div de codigo de barra e imagen del producto -->
             <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div id="print">
                  <svg id="barcode">
                  </svg>
                </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <input type="hidden" name="imagenactual" id="imagenactual">
                    <div name id="cuadritoimagen"> 
                       <img src="" width="150px" height="120px" id="imagenmuestra">
                    </div>
                </div>
             </div>
          <!-- END DE FORMULARIO -->
      </div>
      <div class="modal-footer">
         <button type="submit" id="btnGuardar" name="btnGuardar" class="btn btn-primary btn-md ">
          <span class="fa fa-save" aria-hidden="true"></span>
        </button>
        <button type="button" onclick="cerrarformulario()" class="btn btn-danger btn-md" data-dismiss="modal">
           <span class="fa fa-close" aria-hidden="true"></span>
        </button>
      </div>
      </form>
    </div>
  </div>
   </div>
 </div>
        <?php
        require 'footer.php';
        ?>
         <script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
   <script type="text/javascript" src="scripts/articulo.js"></script>
         


