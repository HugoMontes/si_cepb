<?php require_once("../../config/config.php"); ?>
<?php require_once("../template/header.php"); ?>
<?php 
  require_once("../../controller/InternacionalController.php"); 
  $controller=new InternacionalController("../../conexion/conexion.php");
?>
  <form id="form-estadistico" action="<?php echo BASE_URL; ?>controller/InternacionalAjax.php" method="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            
            <!-- begin: titulo -->            
            <div class="box-header with-border">
              <h3 class="box-title">Indicadores Internacionales</h3>
            </div>
            <!-- end: titulo -->            

            <!-- begin: fuente -->
            <div class="box-body">
              <label for="fuente" class="col-sm-2 control-label">Fuente</label>          
              <div class="col-sm-6">
                <select id="fuente" name="fuente" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option value="0" selected="selected" style="display: none;">Seleccione fuente...</option>
                  <?php 
                    $registros=$controller->getAllFuente();
                    while ($reg=mysqli_fetch_array($registros)){                  
                      echo '<option  value="'.$reg['tabla'].'">'.ucfirst($reg['campos']).'</option>';
                    } 
                  ?>
                </select>
              </div>
              <div class="col-sm-2">
                <a id="btn-excel" href="<?php echo BASE_URL; ?>" class="btn btn-success"><i class="fa fa-file-excel-o fa-lg"></i> Descargar excel</a>
              </div>
            </div>
            <!-- end: fuente -->

            <!-- begin: paises -->
            <div class="box-body">

              <div class="form-group">
                <label for="paises" class="col-sm-2 control-label">Pais: </label>
                <div class="col-sm-4">
                  <select id="pais1" name="pais1" class="form-control select2 select2-hidden-accessible select-pais" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Seleccionar pais...</option> 
                  </select>
                </div>
                <div class="col-sm-4">
                  <select id="pais2" name="pais2" class="form-control select2 select2-hidden-accessible select-pais" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Seleccionar pais...</option> 
                  </select>
                </div>
              </div>
            </div>
            <!-- end: paises -->            

            <!-- begin: Descripcion -->
            <div class="box-body">
              <label for="descripcion" class="col-sm-2 control-label">Descripcion</label>
              <div class="col-sm-8">
                <select id="descripcion" name="descripcion" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" autofocus="true" disabled="true">
                  <option value="0" selected="selected" style="display: none;">Seleccionar descripcion...</option>
                </select>
              </div>
            </div>
            <!-- end: Descripcion -->

            <!-- begin: Periodo -->            
            <div class="box-body">
              <div class="form-group">
                <label for="periodo" class="col-sm-2 control-label">Periodo: </label>
                <div class="col-sm-4">
                  <select id="periodo" name="periodo" class="form-control select2 select2-hidden-accessible select-periodo" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
                    <option value="0" selected="selected" style="display: none;">Seleccionar periodo...</option> 
                  </select>
                </div>
              </div>
            </div>
            <!-- end: Periodo -->            

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
          <div class="grafic col-md-6">
            <h3 class="cuadro-title" style="text-align: center;"></h3>
            <h4 class="cuadro-subtitle" style="text-align: center;"></h4>
            <div id="cuadro-resultante">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th class="col-head-pais1"></th>
                    <th class="col-head-pais2"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="col-nombre-descripcion">$descripcion</td>
                    <td class="col-monto-pais1"></td>
                    <td class="col-monto-pais2"></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!--
            <a href="<?php echo BASE_URL; ?>controller/DescargarDispatcher.php?action=pdf&controlador=historico" class="btn btn-danger btn-descargar" role="button"><i class="fa fa-file-pdf-o fa-lg"></i> Descargar PDF</a>
            <a href="<?php echo BASE_URL; ?>controller/DescargarDispatcher.php?action=excel&controlador=historico" class="btn btn-success btn-descargar" role="button"><i class="fa fa-file-excel-o fa-lg"></i> Descargar EXCEL</a>
            -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Fuente: INE Bolivia
        </div>
        <!-- /.box-footer-->
      </div>
  </section>
  <!-- FIN:GRAFICOS -->
<?php require_once("../template/footer.php"); ?>
<script src="<?php echo BASE_URL; ?>assets/js/internacional.js"></script>