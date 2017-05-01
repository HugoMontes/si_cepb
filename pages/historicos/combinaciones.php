<?php require_once("../../config/config.php"); ?>
<?php require_once("../template/header.php"); ?>
<?php 
  require_once("../../controller/CombinacionController.php"); 
  $controller=new CombinacionController("../../conexion/conexion.php");
?>
  <form id="form-combinaciones" action="<?php echo BASE_URL; ?>controller/CombinacionAjax.php" method="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight: bold;">Combinación de Indicadores</h3>
            </div>

            <div class="box-body box-alert" style="display: none; margin: 0">
              <div class="callout callout-danger" role="alert" style="margin: 0"></div>
            </div>
            
            <div class="box-body">
              <div class="col-md-8 col-md-offset-2">

                <!-- begin: actividad economica 1 -->
                <div class="box-body">
                  <label for="actividad1" class="control-label">Actividad económica 1</label>          
                  <select id="actividad1" name="actividad1" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                    <option value="0" selected="selected" style="display: none;">Seleccione actividad...</option>
                    <?php 
                      $registros=$controller->getAllActividadesEconomicas();
                      while ($reg=mysqli_fetch_array($registros)){                  
                        echo '<option  value="'.$reg['actividad'].'">'.$reg['actividad'].'</option>';
                      } 
                    ?>
                  </select>
                </div>
                <!-- end: actividad economica 1 -->

                <!-- begin: indicador 1 -->
                <div class="box-body">
                  <label for="indicador1" class="control-label">Nombre del indicador 1</label>          
                  <select id="indicador1" name="indicador1" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>
                  </select>
                </div>
                <!-- end: indicador 1 -->
                
                <div class="bg-info">
                  <!-- begin: medicion -->
                  <div class="box-body">
                    <label for="medicion" class="control-label">Medici&oacute;n del indicador</label>          
                    <select id="medicion" name="medicion" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                      <option value="0" selected="selected" style="display: none;">Seleccione medicion...</option>
                    </select>
                  </div>
                  <!-- end: medicion -->

                  <!-- begin: periodo -->            
                  <div class="box-body">
                    <label for="periodo" class="control-label">Periodicidad: </label>
                    <div class="row">
                      <div class="col-md-6">
                        <select id="ini" name="ini" class="form-control select2 select2-hidden-accessible select-ini" tabindex="-1" aria-hidden="true" disabled="true">
                          <option value="0" selected="selected" style="display: none;">Periodo inicial...</option> 
                        </select>
                      </div>
                      <div class="col-md-6">
                        <select id="fin" name="fin" class="form-control select2 select2-hidden-accessible select-fin" tabindex="-1" aria-hidden="true" disabled="true">
                          <option value="0" selected="selected" style="display: none;">Periodo final...</option> 
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- end: periodo -->
                </div>

                <!-- begin: actividad economica 2 -->
                <div class="box-body">
                  <label for="actividad2" class="control-label">Actividad económica 2</label>          
                  <select id="actividad2" name="actividad2" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Seleccione actividad...</option>
                  </select>
                </div>
                <!-- end: actividad economica 2 -->

                <!-- begin: indicador 2 -->
                <div class="box-body">
                  <label for="indicador2" class="control-label">Nombre del indicador 2</label>          
                  <select id="indicador2" name="indicador2" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>
                  </select>
                </div>
                <!-- end: indicador 2 -->

                <!-- begin: boton comparar -->
                <div class="box-body">
                    <input type="hidden" name="proceso" value="generarTabla">
                    <button id="btn-comparar" type="submit" class="btn btn-primary col-md-12" disabled="true">Realizar comparación</button>
                </div>
                <!-- end: boton comparar -->           
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </form>
  
  <!-- INICIO:GRAFICOS -->
  <section class="content resultados-combinacion"  style="display: none;">
      <!-- BEGIN:TABLA_DATOS -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title">Tabla de Datos </h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <table id="cuadro-1" class="table table-striped table-bordered">
              <thead>
                <tr>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <div class="box-footer">
          Fuente: INE Bolivia
        </div>
      </div>
      <!-- END:TABLA_DATOS -->

      <!-- BEGIN:GRAFICO_LINEAL -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Gráfica Lineal</h3>
          <div class="box-tools pull-right">
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'">
          </div>
        </div>
        <div class="box-body">
          <div class="grafic">
            <div id="container-grafico-lineal" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
          </div>
        </div>
      </div>
      <!-- END:GRAFICO_LINEAL -->
  </section>
  <!-- FIN:GRAFICOS -->
<?php require_once("../template/footer.php"); ?>
<script src="<?php echo BASE_URL; ?>assets/js/estadistico-combinaciones.js"></script>