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
              <li><a href="#nuevox"  data-toggle="tab">Nuevo</a></li>
                <li class="active"><a href="#listax" data-toggle="tab">Listado</a></li>
              <li class="pull-left header"><i class="fa fa-inbox"></i>Gestiòn de usuarios</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- listado -->
              <div class="chart tab-pane active" id="listax" style="position: relative;height: 100%;">
             <div class="panel-body table-responsive" id="divlistado">
            <table id="listado" class="table  table-bordered">
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
            <!-- end listado -->
            <!-- registro -->
              <div class="chart tab-pane" id="nuevox" style="position: relative; height: 100%;">
              <div class="panel-body">
             <!-- body form1-->
             <div class="col-lg-9">
            <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h5 class="box-title">Detalle del usuario</h5>
              <div class="box-body">
                <!-- form -->
                  <form name="formulario" id="formulario" method="POST">
                    <input type="hidden" id="idusuario" name="idusuario">
                    <!-- start fila1 -->
                    <div class="row">
                     <!--input codigo  -->
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                    <div class="form-group">
                   <label class="control-label">Codigo</label>
                    <input type="text" class="form-control" name="identi" id="identi" placeholder="Identificacion" autofocus>
                    </div>
                  </div>
                    <!-- input nombre -->
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                     <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="Nombre">
                     </div>
                   </div>
                     <!-- input categoria -->
                     <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                       <div class="form-group">
                      <label class="control-label">Apellido</label>
                     <input type="text" class="form-control" name="apellido" id="apellido"  placeholder="Apellido" >
                     </div>
                   </div>
                   <!-- input cantidad -->
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                     <div class="form-group">
                     <label class="control-label">Direccion</label>
                     <input type="text" class="form-control"  name="direccion" id="direccion" placeholder="Direccion" >
                     </div>
                   </div>
                 </div>
                 <!-- end fila 1 -->
                 <!-- start fila2 -->
                 <div class="row">
                  <div class="col-lg-3 col-md-3 col-xs-12 col-sm-7">
                     <div class="form-group">
                     <label class="control-label">Telefono</label>
                      <input name="telefono" id="telefono" class="form-control"  required="required" placeholder="Tel:"></input>
                     </div>
                   </div>
                   <div class="col-lg-3 col-md-3 col-xs-12 col-sm-5">
                    <div class="form-group">
                     <label class="control-label">Rango</label>
                      <select name="cargo" id="cargo" class="form-control">
                        <option value="ADMIN">Administrador</option>
                        <option value="Vendedor">Vendedor</option>
                      </select>
                     </div> 
                   </div>
                   <div class="col-lg-3 col-md-3 col-xs-12 col-sm-7">
                     <div class="form-group">
                     <label class="control-label">Correo</label>
                      <input type="email" name="correo" id="correo" class="form-control"  required="required" placeholder="@gmail"></input>
                     </div>
                   </div>
                    <div class="col-lg-3 col-md-3 col-xs-12 col-sm-5">
                     <div class="form-group">
                     <label class="control-label">Clave</label>
                      <input type="text" name="clave" id="clave" class="form-control"  required="required" placeholder="*******"></input>
                     </div>
                   </div>
                 </div>
                   <!-- fila3 -->
                   <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-12 col-sm-7">
                      <div class="form-group">
                     <label class="control-label">Presentaciòn</label>
                    <input type="file" class="form-control" name="imagen" id="imagen">
                     </div>
                    </div>
                     <div class="col-lg-3 col-md-3 col-xs-12 col-sm-5">
                      <div class="form-group">
                     <label class="control-label">confirmar</label>
                      <input type="text" name="confirmPassword" id="confirmPassword" 
                      class="form-control"  required="required" placeholder="*******"></input>
                     </div>
                   </div>
                   </div>
                 <br><br>
              <!-- end box-body -->
              <div class="form-group">
                <button type="button" onclick="cerrarformulario()" class="btn btn-danger pull-left">Cancelar</button>
                <button type="submit" class="btn btn-success pull-right">Guardar</button>
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
                  <img src="" width="98px" height="102px" id="imagenmuestra">
                 </center>
             </div>
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
   <script type="text/javascript" src="scripts/usuario.js"></script>
  




