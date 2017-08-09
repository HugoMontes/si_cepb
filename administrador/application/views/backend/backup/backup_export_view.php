<?php $this->load->view('backend/template/header'); ?>
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

<div class="panel panel-default">
  <div class="panel-body">
    
    <div class="jumbotron" style="text-align: center;">
	  <p>Inicie la copia de seguridad de la base de datos presionando sobre el siguiente botón:</p>
	  <p><a class="btn btn-primary btn-lg" href="<?php echo base_url('index.php/backend/backup/exportar'); ?>" role="button"><i class="fa fa-download" aria-hidden="true"></i> Generar Respaldo</a></p>
	</div>

  </div>
</div>

<?php $this->load->view('backend/template/footer'); ?>