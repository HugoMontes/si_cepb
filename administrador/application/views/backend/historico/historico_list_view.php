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

<div>
<?php if (isset($mensaje)) { ?>
	<br>
	<div class="alert alert-success alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $mensaje;?>
	</div>
<?php    
	$this->session->unset_userdata('mensaje');
} elseif (isset($error)) {
?>      
	<br>          
	<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php echo $error;?>
	</div>          
<?php
	$this->session->unset_userdata('error');
}?>                
</div>   

<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Seleccionar indicador</h3>
  </div>
  <div class="panel-body">
  	<form id="form-estadistico" action="<?php echo base_url('index.php/backend/historico/'); ?>" class="form-horizontal">
	    <!-- begin: actividad economica -->
	    <div class="form-group">
	    	<label for="actividad" class="col-sm-3 control-label">Actividad económica</label>          
	    	<div class="col-sm-8">
	    		<select id="actividad" name="actividad" class="form-control" tabindex="-1" aria-hidden="true">
	    			<option value="0" selected="selected" style="display: none;">Seleccione actividad...</option>
	    			<?php foreach ($actividades as $actividad) { ?>
	    				<option value="<?php echo $actividad->id; ?>"><?php echo $actividad->descripcion; ?></option>
	    			<?php } ?>
	    		</select>
	    	</div>
	    </div>
	    <!-- end: actividad economica -->

	    <!-- begin: grupo -->
	    <div class="form-group">
	    	<label for="grupo" class="col-sm-3 control-label">Grupo</label>
	    	<div class="col-sm-8">
	    		<select id="grupo" name="grupo" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" disabled="true">
	    			<option value="0" selected="selected" style="display: none;">Seleccione grupo...</option>
	    		</select>
	    	</div>
	    </div>
	    <!-- end: grupo -->

	    <!-- begin: medicion -->
	    <div class="form-group">
	    	<label for="medicion" class="col-sm-3 control-label">Medición</label>
	    	<div class="col-sm-8">
	    		<select id="medicion" name="medicion" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" disabled="true">
	    			<option value="0" selected="selected" style="display: none;">Seleccione medicion...</option>
	    		</select>
	    	</div>
	    </div>
	    <!-- end: medicion -->

	    <!-- begin: indicador -->
	    <div class="form-group">
	    	<label for="indicador" class="col-sm-3 control-label">Indicador</label>
	    	<div class="col-sm-8">
	    		<select id="indicador" name="indicador" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true" disabled="true">
	    			<option value="0" selected="selected" style="display: none;">Seleccione indicador...</option>
	    		</select>
	    	</div>
	    </div>
	    <!-- end: indicador -->

    </form>
  </div>
</div>

<div id="pnl-editar-indicador" class="panel panel-primary" style="display: none;">
  <div class="panel-heading">
    <h3 id="pnl-title" class="panel-title">Datos del indicador</h3>
  </div>
  <form action="<?php echo base_url('index.php/backend/historico/'); ?>" method="post">
	  <div class="panel-body">
		  <div class="form-group">
		    <label for="txt_archivo">Archivo excel:</label>
		    <input type="text" id="txt_archivo" name="txt_archivo" class="form-control" value="excel/002_agricultura/A002.xlsx" disabled="disabled">
		  </div>
		  <div class="form-group">
		    <label for="txt_desagregacion">Desagregación:</label>
		    <input type="text" id="txt_desagregacion" name="txt_desagregacion" class="form-control" placeholder="Ingresar desagregación">
		  </div>
		  <div class="form-group">
		    <label for="txt_medicion">Medición:</label>
		    <input type="text"  id="txt_medicion" name="txt_medicion" class="form-control" placeholder="Ingresar medición">
		  </div>
		  <div class="form-group">
		    <label for="txt_unidad_medida">Unidad de medida:</label>
		    <input type="text"  id="txt_unidad_medida" name="txt_unidad_medida" class="form-control" placeholder="Ingresar medición">
		  </div>
		  <div class="form-group">
		    <label for="txt_cobertura">Cobertura:</label>
		    <input type="text"  id="txt_cobertura" name="txt_cobertura" class="form-control" placeholder="Ingresar medición">
		  </div>
		  <div style="text-align: right;">
		  	<a id="btn-download-excel" href="<?php echo base_url('index.php/backend/historico/download/excel'); ?>" class="btn btn btn-info"><span class="glyphicon glyphicon-download-alt"></span> Descargar archivo excel</a>
		  	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#mdl-upload-excel"><span class="glyphicon glyphicon-upload"></span> Subir archivo excel</button>
		  </div>	  
	  </div>
   	  <small class="form-text text-muted" style="margin-left: 2px;">La siguiente tabla es editable.</small>
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
	  <div class="panel-footer" style="text-align: right;">
	  	<a href="<?php base_url('backend/historico'); ?>" class="btn btn-default">Cancelar</a>
	  	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mdl-verificar-guardar" disabled="true"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar cambios</button>
	  </div>
  </form> 
</div>

<!-- begin : Modal guardar cambios tabla -->
<div class="modal fade" id="mdl-verificar-guardar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Advertencia!</h4>
      </div>
      <div class="modal-body">
        Los cambios realizados no podran ser desechos.<br>
        Esta seguro que desea confirmar guardar los cambios?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Confirmar guardar cambios</button>
      </div>
    </div>
  </div>
</div>
<!-- end : Modal guardar cambios tabla -->

<!-- begin : Modal subir archivo excel -->
<div class="modal fade" id="mdl-upload-excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Subir archivo excel</h4>
      </div>
      <form role="form" action="<?php echo base_url('index.php/backend/historico/upload/excel');?>" enctype="multipart/form-data" method="post">
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
<script src="<?php echo base_url();?>resources/js/indicadores.js"></script>