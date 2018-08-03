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
              <li class="pull-left header"><i class="fa fa-inbox"></i>Proveedor</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- listado -->
              <div class="chart tab-pane active" id="listax" style="position: relative;height: 100%;">
             <div class="panel-body table-responsive" id="divlistado">
           <table id="listadop" class="table  table-bordered">
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
            <!-- end listado -->
            <!-- registro -->
              <div class="chart tab-pane" id="nuevox" style="position: relative; height: 100%;">
              <div class="panel-body">
             <!-- body form1-->
            <div class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h5 class="box-title">Registrar Proveedores</h5>
              <div class="box-body">
                <!-- form -->
               <form name="formulario" id="formulario" method="POST">
               <input type="hidden" id="idpersona" name="idpersona">
              <input type="hidden" value="provedor" name="tipo_persona" id="tipo_persona">
                <!-- fila1 -->
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                    <div class="form-group">
                     <label class="control-label">T.Documento</label>
                      <select name="tipo_documento" id="tipo_documento" class="form-control">
                        <option value="TI">TI</option>
                        <option value="CC">CC</option>
                      </select>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">#Documento</label>
                      <input type="text" class="form-control" name="num_documento" id="num_documento"
                      placeholder="Identifiacion" autofocus>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">Nombre</label>
                      <input type="text" class="form-control" name="nombre" id="nombre"
                      placeholder="Nombre">
                     </div>
                  </div>
                   <div class="col-lg-5 col-md-3 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">Apellido</label>
                      <input type="text" class="form-control" name="apellido" id="apellido"
                      placeholder="Apellido">
                     </div>
                  </div>
                </div>
                <!-- fila2 -->
                <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">Ciudad</label>
                     <select name="ciudad" id="ciudad" class="form-control" onchange="ciudadvalidate()">
                    <option value="VALLEDUPAR">Valledupar</option>
                    <option value="MEDELLIN" >Medellin</option>
                  </select>
                  </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 ">
                <div class="form-group">
                 <label class="control-label">Barrio</label>
                   <select id="barrio" name="barrio" class="form-control"></select>
                 </div>
                </div>
                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">Direccion</label>
                      <input type="text" class="form-control" name="direccion" id="direccion"
                      placeholder="Direccion">
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-5 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">Telefono</label>
                      <input type="text" class="form-control" name="telefono" id="telefono"
                      placeholder="telefono">
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-5 col-sm-6 col-xs-12 ">
                   <div class="form-group">
                     <label class="control-label">@Gmail</label>
                      <input type="email" class="form-control" name="email" id="email"
                      placeholder="Correo electronico">
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
            </form>
          </div>
        </div>
             </div>
              </div>

          </section>
        </div>

        <?php
        require 'footer.php';
        ?>
   <script type="text/javascript" src="scripts/persona.js"></script>






