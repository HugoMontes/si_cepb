<?php require_once("../../config/config.php"); ?>
<?php require_once("../template/header.php"); ?>
<?php 
  require_once("../../controller/CoyunturaController.php"); 
  $controller=new CoyunturaController("../../conexion/conexion.php");
?>
  <form id="form-estadistico" action="<?php echo BASE_URL; ?>controller/CoyunturaAjax.php" method="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Indicadores de Coyuntura</h3>
            </div>          
            <div class="box-body">
              <label for="inputEmail3" class="col-sm-2 control-label">Actividad Económica</label>          
              <div class="col-sm-8">
                <!--valor departamento segundo select-->
                <select class="form-control select2 select2-hidden-accessible select-actividad" style="width: 100%;" tabindex="-1" aria-hidden="true" id="selectNacio1" name="selectNacio1">
                  <option value="0" selected="selected" style="display: none;">Seleccione una actividad...</option>
                  <?php 
                    $registros=$controller->getAllActividadEconomica();
                    while ($reg=mysqli_fetch_array($registros)){                  
                      echo '<option  value="'.$reg['tabla'].'">'.$reg['campos'].'</option>';
                    } 
                  ?>
                </select>
              </div>
            </div>

            <div class="box-body">
              <label for="inputEmail3" class="col-sm-2 control-label">Indicador</label>
              <div class="col-sm-6">
                <select class="form-control select2 select2-hidden-accessible select-indicador" style="width: 100%;" tabindex="-1" aria-hidden="true" id="indicador1" name="indicador1" autofocus="true" disabled="true">
                  <option value="0" selected="selected" style="display: none;">Seleccione el indicador...</option>
                </select>
              </div>
              <div class="col-sm-2">
                <a id="btn-excel" href="<?php echo BASE_URL; ?>" class="btn btn-success"><i class="fa fa-file-excel-o fa-lg"></i> Descargar excel</a>
              </div>
            </div>

            <div class="box-body">
              <label for="inputEmail3" class="col-sm-2 control-label">Cobertura</label>
              <div class="col-sm-8">
                <select class="form-control select2 select2-hidden-accessible select-cobertura" style="width: 100%;" tabindex="-1" aria-hidden="true" id="selectDepart1" name="selectDepart1" disabled="true">
                  <option value="0" selected="selected" style="display: none;">Seleccione la cobertura...</option>
                </select>
              </div>
            </div>

            <div class="box-body">
              <label for="inputEmail3" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-8">
                <select class="form-control select2 select2-hidden-accessible select-descripcion" style="width: 100%;" tabindex="-1" aria-hidden="true" id="des1" name="des1" autofocus="true" disabled="true">
                  <option value="0" selected="selected" style="display: none;">Seleccione una descripcion...</option>
                </select>
              </div>
            </div>
            
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Periodo Desde: </label>
                <div class="col-sm-3">
                  <select class="form-control select2 select2-hidden-accessible select-ini" style="width: 100%;" tabindex="-1" aria-hidden="true" id="ini" name="ini" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Periodo inicial...</option> 
                  </select>
                </div>
                <label class="col-xs-2" style="text-align: center;">hasta:</label>
                  <div class="col-sm-3">
                    <select class="form-control select2 select2-hidden-accessible select-fin" style="width: 100%;" tabindex="-1" aria-hidden="true" id="fin" name="fin" onchange="ShowSelected();" disabled="true">
                      <option value="0" selected="selected" style="display: none;">Periodo final...</option> 
                    </select>
                  </div>
              </div>
            </div>

            <div class="box-body">
              <div class="form-group col-xs-12 col-md-5 col-md-offset-2">
                    <button id="btn-enviar" type="submit" class="btn btn-primary col-xs-12 col-sm-6" disabled="true">Continuar</button> 
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </form>
  
  <!-- INICIO:GRAFICOS -->
  <section class="content resultados">
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title">Tabla de Datos </h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <table id="cuadro-1" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Gestion</th>
                  <th>Serie</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
            <a href="<?php echo BASE_URL; ?>controller/DescargarDispatcher.php?action=pdf&controlador=coyuntura" class="btn btn-danger btn-descargar" role="button"><i class="fa fa-file-pdf-o fa-lg"></i> Descargar en PDF</a>
            <a href="<?php echo BASE_URL; ?>controller/DescargarDispatcher.php?action=excel&controlador=coyuntura" class="btn btn-success btn-descargar" role="button"><i class="fa fa-file-excel-o fa-lg"></i> Descargar EXCEL</a>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Fuente: INE Bolivia
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- BEGIN:GRAFICO_LINEAL -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfica Lineal</h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <div id="container-grafico-lineal" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
      <!-- END:GRAFICO_LINEAL -->

      <!-- BEGIN:GRAFICO_BARRAS -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfica Barras</h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <div id="container-grafico-barras" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
      <!-- END:GRAFICO_BARRAS -->

      <!-- BEGIN:GRAFICO_TORTA -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfica Torta</h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <div id="container-grafico-torta" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
      <!-- END:GRAFICO_TORTA -->

      <!-- BEGIN:GRAFICO_ROTATORIA -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfica Rotatoria</h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <div id="container-grafico-rotatorio" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            <div id="sliders" style="min-width: 310px; max-width: 800px; margin: 0 auto;">
              <table>
                  <tr>
                    <td>Alpha Angle</td>
                    <td>&nbsp;<input id="alpha" type="range" min="0" max="45" value="15"/></td>
                    <td>&nbsp;<span id="alpha-value" class="value"></span></td>
                  </tr>
                  <tr>
                    <td>Beta Angle</td>
                    <td>&nbsp;<input id="beta" type="range" min="-45" max="45" value="15"/></td>
                    <td>&nbsp;<span id="beta-value" class="value"></span></td>
                  </tr>
                  <tr>
                    <td>Depth</td>
                    <td>&nbsp;<input id="depth" type="range" min="20" max="100" value="50"/></td>
                    <td>&nbsp;<span id="depth-value" class="value"></span></td>
                  </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- END:GRAFICO_ROTATORIA -->

      <!-- BEGIN:GRAFICO_AREAS -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfica por Areas</h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <div id="container-grafico-area" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
      <!-- END:GRAFICO_AREAS -->
  </section>
  <!-- FIN:GRAFICOS -->
<?php require_once("../template/footer.php"); ?>
<script src="<?php echo BASE_URL; ?>assets/js/estadistico.js"></script>