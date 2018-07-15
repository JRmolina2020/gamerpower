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
             <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#listadox">Historial</a></li>
              <li><a data-toggle="tab" onclick="activar()" href="#agregarx">Comprar</a></li>
            </ul>
          </a>
        </div>

        <div class="tab-content">
          <div id="listadox" class="tab-pane fade in active">
            <div class="panel-body table-responsive" id="divlistado">
              <table id="listado" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Opciones</th>
                  <th>Fecha</th>
                  <th>Proveedor</th>
                  <th>Vendedor</th>
                  <th>Compra Nº</th>
                  <th>Total compra</th>
                   <th>Neto</th>
                    <th>Iva 18%</th>
                     <th>Total final</th>
                  <th>Estado</th>
                </thead>
                <tbody>                            
                </tbody>
              </table>
            </div>
          </div>
          <div id="agregarx" class="tab-pane fade">
           <div class="panel-body table-responsive" id="divlistado">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Detalles de la compra</h3>
              </div>
              <div class="box-body">
                <!-- FORMULARIO INGRESO -->
                <form name="formulario" id="formulario" method="POST">
                  <div class="row">
                    <!-- proveedor select -->
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <label>Proveedor</label>
                    <input type="hidden" name="idingreso" id="idingreso">
                    <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required>
                    </select>
                  </div>
                  <!-- end proveedor select -->
                  <!-- fecha -->
                    <div class="form-group col-lg-2 col-md-2 col-sm-12 col-xs-12">
                    <label>Fecha</label>
                    <input type="text"  class="form-control" name="fecha_hora" id="fecha_hora" required="">
                    </div>
                  <!-- end fecha -->
                  <!-- #decompra -->
                   <div class="form-group col-lg-2 col-md-3 col-sm-12 col-xs-12">
                    <label>Compra Nº</label>
                    <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número de compra" required="">
                  </div>
                  <!-- end #compra -->
                  <!-- button guardar ingreso -->
                   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <label>Agregar Productos</label>
                    <a data-toggle="modal" href="#myModal">           
                      <button id="btnAgregarArt" type="button" class="btn btn-info">
                        Buscar Productos
                        <i class="fa fa-search"></i>
                      </button>
                    </a>
                  </div>
                  <!-- end button guardar ingreso -->
                  </div>
                  <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table id="detalles" class="table table table-sm ">
                      <thead>
                        <th>Opciones</th>
                        <th>Artículo</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Subtotal</th>
                      </thead>
                        <tfoot>
                        <th>
                        TOTAL
                        <br>
                        $NETO<br>
                        IVA 18%<br>
                        TOTAL COMPRA

                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>
                          <h5 id="total">$/. 0.000</h5><input type="hidden" name="total_compra" id="total_compra">
                          <h5 id="neto">$/. 0.000</h5><input type="hidden" name="total_neto" id="total_neto">
                          <h5 id="iva">$/. 0.000</h5><input type="hidden" name="total_iva" id="total_iva">
                          <h5 id="totalfinal">S/. 0.000</h5><input type="hidden" name="total_cfinal" id="total_cfinal">
                        </th> 
                      </tfoot>
                      <tbody>
                      </tbody>
                    </table>
                  </div>

                  <div id="guardar" class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                    <button id="btnCancelar" class="btn btn-danger" onclick="cerrarformulario()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                </form>
                <!-- END FORMULARIO INGRESO -->
              </div>
            </div>
          </diV>
        </div>
      </div>
    </div>
  </div>
  </div><!-- /.col -->
  </div><!-- /.row -->
  </section><!-- /.content -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Artículo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Código</th>
              <th>Stock</th>
              <th>Imagen</th>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Categoría</th>
              <th>Código</th>
              <th>Stock</th>
              <th>Imagen</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
  </div>

  <?php
  require 'footer.php';
  ?>

  <script type="text/javascript" src="scripts/ingreso.js"></script>



