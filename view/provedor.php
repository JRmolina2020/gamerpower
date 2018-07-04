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
          <div class="panel-body table-responsive" id="divlistadop">
            <table id="listadop" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Opciones</th>
                <th>TD</th>
                <th>Identificacion</th>
                <th>Nombre</th>
                 <th>Apellido</th>
                  <th>Barrio</th>
                  <th>Direccion</th>
                  <th>Ciudad</th>
                  <th>Telefono</th>
                 <th>Correo</th>
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
             <input type="hidden" id="idpersona" name="idpersona">
              <input type="hidden" value="provedor" id="tipo_persona" name="tipo_persona">
             <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                <label>Tipo de documento</label>
                <select name="tipo_documento" id="tipo_documento" class="form-control">
                   <option value="CC" selected="selected">CC</option>
                  <option value="TI">TI</option>
                </select>
              </div>
               </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                 <div class="form-group">
              <label>identificacion:</label>
              <input type="text" class="form-control" name="num_documento" id="num_documento" placeholder="Identifiacion">
            </div>   
               </div>
             </div>
              <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <div class="form-group">
                  <label>Nombre:</label>
                  <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre del cliente" >
                </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <div class="form-group">
                  <label>Apellido:</label>
                  <input type="text" class="form-control" name="apellido" id="apellido"  placeholder="Apellido del cliente" >
                </div>
               </div>
             </div>
             <div class="row">
              <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                   <label>Ciudad:</label>
                  <input type="text" class="form-control" name="ciudad" id="ciudad"  placeholder="Direccion" >
                   </div>
                  </div>
               <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                   <label>Barrio:</label>
                <select name="barrio" id="barrio" class="form-control">
                   <option value="1 DE MAYO" selected>1 DE MAYO</option>
                  <option value="1 ENERO">1 ENERO</option>
                </select>
                   </div>
                  </div>
                 <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <div class="form-group">
                   <label>Direccion:</label>
                  <input type="text" class="form-control" name="direccion" id="direccion"  placeholder="Direccion" >
                   </div>
                  </div>
                 </div>
              <div class="row">
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <label>Telefono:</label>
                 <div class="form-group">
                    <input type="text" class="form-control" name="telefono" id="telefono"  placeholder="Telefono" >
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="form-group">
                  <label>Correo:</label>
                  <input type="email" class="form-control" name="email" id="email"  placeholder="Ejemplo:OutJ66@gmail.com" >
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
   <script type="text/javascript" src="scripts/persona.js"></script>
         


