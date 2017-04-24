<?php $this->load->view('backend/template/header'); ?>

<style>
	table#tbl-indicadores {
        display: block;
        overflow-x: auto;
        height: 400px;
    }
    #tbl-indicadores th, #tbl-indicadores td{
    	white-space: nowrap;
    }
</style>
 
<div class="panel panel-primary">
  	<div class="panel-heading">
    	<h3 class="panel-title">Seleccionar indicador</h3>
  	</div>
  	<div class="panel-body">
  		<form id="form-estadistico" action="<?php echo base_url('index.php/backend/internacional/'); ?>" class="form-horizontal">
			<!-- begin: fuente -->
			<div class="form-group">
				<label for="fuente" class="col-sm-2 control-label">Fuente</label>          
				<div class="col-sm-6">
					<select id="fuente" name="fuente" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
						<option value="0" selected="selected" style="display: none;">Seleccione fuente...</option>
						<?php foreach ($fuentes as $fuente) { ?>
		    				<option value="<?php echo $fuente->id; ?>"><?php echo $fuente->campos; ?></option>
		    			<?php } ?>
					</select>
				</div>
			</div>
			<!-- end: fuente -->

			<!-- begin: Periodo -->
			<div class="form-group">
				<label for="periodo" class="col-sm-2 control-label">Periodo: </label>
				<div class="col-sm-6">
					<select id="periodo" name="periodo" class="form-control select2 select2-hidden-accessible select-periodo" style="width: 100%;" tabindex="-1" aria-hidden="true" disabled="true">
						<option value="0" selected="selected" style="display: none;">Seleccionar periodo...</option> 
					</select>
				</div>
			</div>
			<!-- end: Periodo -->
		</form>
  	</div>
</div>

<div id="pnl-editar-indicador" class="panel panel-primary" style="display: none;">
<!--div id="pnl-editar-indicador" class="panel panel-primary"-->
  	<div class="panel-heading">
    	<h3 id="pnl-title" class="panel-title">Datos del indicador</h3>
  	</div>
  	<form action="<?php echo base_url('index.php/backend/historico/'); ?>" method="post">
  		<div class="panel-body">
			<div style="text-align: right;">
			  	<a id="btn-download-excel" href="<?php echo base_url('index.php/backend/internacional/download/excel'); ?>" class="btn btn btn-info"><span class="glyphicon glyphicon-download-alt"></span> Descargar archivo excel</a>
			  	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#mdl-upload-excel"><span class="glyphicon glyphicon-upload"></span> Subir archivo excel</button>
			</div>
		</div>
		<div class="table-responsive">
			<table id="tbl-indicadores" class="table table-bordered">
				<thead>
					<tr class="bg-info">
					</tr>
				</thead>
				<tbody contenteditable='true'>
					<tr>
					</tr>
				</tbody>
			</table>
		</div>		
	</form> 
</div>

<!-- begin : Modal subir archivo excel -->
<div class="modal fade" id="mdl-upload-excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir archivo excel</h4>
      </div>
      <form role="form" action="<?php echo base_url('index.php/backend/internacional/upload/excel');?>" enctype="multipart/form-data" method="post">
	      <div class="modal-body">
			  <div class="form-group">
			    <label for="upload_indicador">Indicador:</label>
			    <input type="text" id="upload_indicador" class="form-control" disabled="true">
			  </div>
			  <div class="form-group">
			    <label for="archivo_excel">Archivo excel:</label>
			    <input type="file" id="archivo_excel" name="archivo_excel" class="form-control btn btn-default" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
			    <p class="help-block">Seleccionar un archivo con extension .xlsx no mayor a 5 MB.</p>
			  </div>
	      </div>
	      <input type="hidden" id="txt_upload_tabla" name="txt_upload_tabla">
	      <input type="hidden" id="txt_upload_indicador" name="txt_upload_indicador">
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary">Guardar cambios</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- end : Modal subir archivo excel -->

<?php $this->load->view('backend/template/footer'); ?>
<script src="<?php echo base_url();?>resources/js/internacional.js"></script>