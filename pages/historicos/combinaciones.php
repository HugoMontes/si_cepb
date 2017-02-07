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
        <div class="col-md-6 col-md-offset-3">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title" style="font-weight: bold;">Combinación de Indicadores</h3>
            </div>

            <div class="box-body box-alert" style="display: none; margin: 0">
              <div class="callout callout-danger" role="alert" style="margin: 0"></div>
            </div>

            <?php 
              $indicadores=$controller->getAllCombinados();
              while ($indicador=$indicadores->fetch_assoc()) { ?>
              <div class="box-body">
                <p class="col-sm-10"><?php echo $indicador['B']; ?></p>          
                <div class="col-sm-2">
                  <input type="checkbox" value="<?php echo $indicador['id']; ?>" name="cbxIndicador[]"/>
                </div>
              </div>              
            <?php } ?>

            <div class="box-body">
                <button id="btn-comparar" type="submit" class="btn btn-primary col-xs-12">Realizar Comparación</button> 
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
            <input class="btn btn-block btn-primary btn-xs" type="button" value="Abrir" data-widget="collapse" data-toggle="tooltip" id="botonmostrar" onclick="this.value='Cerrar'"">
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
  </section>
  <!-- FIN:GRAFICOS -->
<?php require_once("../template/footer.php"); ?>
<script src="<?php echo BASE_URL; ?>assets/js/estadistico-combinaciones.js"></script>