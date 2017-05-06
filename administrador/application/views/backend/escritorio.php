<?php $this->load->view('backend/template/header'); ?>
<br>
<div class="row">

  <a href="<?php echo base_url('index.php/backend/historico'); ?>">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder bg-color-green">
        <div class="panel-body">
          <i class="fa fa-line-chart fa-5x"></i>
          <!--h3>8,457</h3-->
        </div>
        <div class="panel-footer back-footer-green">
          Historicos
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('index.php/backend/coyuntura'); ?>">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder bg-color-brown">
        <div class="panel-body">
          <i class="fa fa-area-chart fa-5x"></i>
          <!--h3>52,160 </h3-->
        </div>
        <div class="panel-footer back-footer-brown">
          Coyuntura
        </div>
      </div>
    </div>
  </a>
  <a href="<?php echo base_url('index.php/backend/internacional'); ?>">
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="panel panel-primary text-center no-boder bg-color-blue">
        <div class="panel-body">
          <i class="fa fa-globe fa-5x"></i>
          <!--h3>36,752 </h3-->
        </div>
        <div class="panel-footer back-footer-blue">
          Internacional
        </div>
      </div>
    </div>
  </a>
  <!--
  <div class="col-md-3 col-sm-12 col-xs-12">
    <div class="panel panel-primary text-center no-boder bg-color-red">
      <div class="panel-body">
        <i class="fa fa fa-comments fa-5x"></i>
        <h3>15,823 </h3>
      </div>
      <div class="panel-footer back-footer-red">
        Comments
      </div>
    </div>
  </div>
  -->
</div>

<div class="row">
    <div class="col-md-7 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Ultimas cinco visitas
      </div> 
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Nro.</th>
                <th>Seccion</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php $cont=1; ?>
              <?php foreach ($ultimas_visitas as $uv) { ?>
              <tr>
                <td><?php echo $cont++; ?></td>
                <td><?php echo $uv->seccion; ?></td>
                <th><?php echo $uv->fecha_visita; ?></th>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-5 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Visitas por sección
      </div> 
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Seccion</th>
                <th>Nro de veces visitada</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($visitas_seccion as $vs) { ?>
              <tr>
                <td><?php echo $vs->seccion; ?></td>
                <td><?php echo $vs->total; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /. ROW  -->

<div class="row">
  <div class="col-md-7 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Bar Chart Example
      </div>
      <div class="panel-body">
        <div id="morris-bar-chart"></div>
      </div>
    </div>
  </div>
  <div class="col-md-5 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Donut Chart Example
      </div>
      <div class="panel-body">
        <div id="morris-donut-chart"></div>
      </div>
    </div>
  </div>
</div>
<!-- /. ROW  -->

<?php $this->load->view('backend/template/footer'); ?>
<!-- Morris Chart Js -->
<script src="<?php echo base_url('resources/assets/js/morris/raphael-2.1.0.min.js');?>"></script>
<script src="<?php echo base_url('resources/assets/js/morris/morris.js');?>"></script>
<!-- Custom Js -->
<script src="<?php echo base_url();?>resources/assets/js/custom-scripts.js"></script>

