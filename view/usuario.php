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
                <th>Identi</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Direccion</th>
                <th>Telefono</th>
                  <th>Cargo</th>
                  <th>Correo</th>
                <th>Imagen</th>
                 <th>Condicion</th>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      
      <div class="modal-body">
        <!-- INICIO DE FORMULARIO -->
       <form name="formulario" id="formulario" method="POST">
             <input type="hidden" id="idusuario" name="idusuario">
             <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
              <div class="form-group">
              <label>Identifiacion:</label>
              <input type="text" class="form-control" name="identi" id="identi" placeholder="Identificacion">
            </div>      
               </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <div class="form-group">
                  <label>Nombre:</label>
                  <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre del vendedor" >
                </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <div class="form-group">
                  <label>Apellido:</label>
                  <input type="text" class="form-control" name="apellido" id="apellido"  placeholder="Apellido del vendedor" >
                </div>
               </div>
             </div>
              <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <div class="form-group">
                  <label>Direccion:</label>
                  <input type="text" class="form-control" name="direccion" id="direccion"  placeholder="Direccion" >
                </div>
               </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <div class="form-group">
                  <label>Telefono:</label>
                  <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono" >
                </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                  <div class="form-group">
                  <label>Cargo:</label>
                  <select name="cargo" id="cargo" class="form-control">
                    <option value="ADMIN" selected>Administrador</option>
                    <option value="Vendedor">Vendedor</option>
                  </select>
                </div>
               </div>
             </div>
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                 <label>Correo:</label>
                 <input type="email" class="form-control" name="correo" id="correo"  placeholder="Correo" >
               </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                 <label>Clave:</label>
                 <input type="password" class="form-control" name="clave" id="clave"  placeholder="Clave" >
               </div>
                  </div>
                   <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                  <div class="form-group">
                      <label>Password confirm:</label>
                        <input type="password" class="form-control" value="" id="confirmPassword" name="confirmPassword"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                <label>Imagen:</label>
                 <div class="form-group">
                     <input type="file" class="form-control" name="imagen" id="imagen">
                   </div>
                 </div>
                   <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
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
       
   <script type="text/javascript" src="scripts/usuario.js"></script>
         


