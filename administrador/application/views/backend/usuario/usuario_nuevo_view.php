<?php $this->load->view('backend/template/header'); ?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- inicio cuadro mensaje -->                
			<?php if (isset($mensaje)) { ?>
				<div class="callout callout-success">
					<h4>Mensaje</h4>
					<p><?php echo $mensaje;?></p>
				</div>
				<?php    
				$this->session->unset_userdata('mensaje');
			} elseif (isset($error)) { ?>                
				<div class="callout callout-danger">
					<h4>Error</h4>

					<p><?php echo $error;?></p>
				</div>          
			<?php
				$this->session->unset_userdata('error');
			}?>
			<!-- fin cuadro mensaje  -->   

			<div class="panel panel-default">
			 	<div class="panel-heading">
			    <h3 class="panel-title">
			    	<small>Todos los campos marcados con * son obligatorios</small>
			    </h3>
			  </div>
  			<div class="panel-body"> 
						<form action="#">
							<div class="form-group">
								<label for="usuario">Nombre de usuario <span class="required">*</span></label>
								<?php echo form_error('usuario', '<span class="error-form">', '</span><br/><br/>'); ?>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="form-control " id="usuario" name="usuario" value="<?php echo set_value('usuario');?>" placeholder="Nombre de usuario"/>
									</div>
								</div>      
							</div>
							<!-- begin : email -->
							<div class="form-group">
								<label for="email">Correo electrónico  <span class="required">*</span></label>
								<?php echo form_error('email', '<span class="error-form">', '</span><br/><br/>'); ?>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="form-control " id="email" name="email" value="<?php echo set_value('email');?>" placeholder="Correo electrónico"/>
									</div>
								</div>      
							</div>
							<!-- end : email -->   

							<!-- begin : nombres -->                                                 
							<div class="form-group">
								<label for="nombres">Nombres <span class="required">*</span></label>
								<?php echo form_error('nombres', '<span class="error-form">', '</span><br/><br/>'); ?>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="form-control " id="nombres" name="nombres" value="<?php echo set_value('nombres');?>" placeholder="Nombres"/>
									</div>
								</div>      
							</div>
							<!-- end : nombres -->  

							<!-- begin : apellidos -->  
							<div class="form-group">
								<label for="apellidos">Apellidos <span class="required">*</span></label>
								<?php echo form_error('apellidos', '<span class="error-form">', '</span><br/><br/>'); ?>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="form-control " id="apellidos" name="apellidos" value="<?php echo set_value('apellidos');?>" placeholder="Apellidos"/>
									</div>
								</div>      
							</div>
							<!-- end : apellidos -->

							<!-- begin : password --> 
							<div class="form-group">
								<label for="password">Contraseña <span class="required">*</span></label>
								<?php echo form_error('password', '<span class="error-form">', '</span><br/><br/>'); ?>
								<div class="row">
									<div class="col-lg-6">
										<input type="text" class="form-control login-field-password" id="password" name="password" value="<?php echo set_value('password');?>"/>
										<a href="javascript:generar_password(12);" class="btn btn-primary" style="margin-top: 10px;">Generar Contraseña</a>
									</div>
								</div>      
							</div>
							<!-- end : password -->

							<!-- begin : aviso -->  
							<div class="form-group">
								<label for="">Enviar aviso al usuario</label>
								<div class="checkbox" style="margin-top: 0px;">
									<label>
										<input type="checkbox" id="enviar_notificacion" name="enviar_notificacion" value="1"
										<?php echo set_checkbox('enviar_notificacion', '1', TRUE); ?> />
										Envía al usuario un correo electrónico con información sobre su cuenta (Nombre de usuario y contraseña).
									</label>
								</div>  
							</div>
							<!-- end : aviso -->

							 <!-- begin : perfil -->                                                                                                             
							 <div class="form-group">
							 	<label for="perfil">Perfil</label>
							 	<?php echo form_error('perfil', '<span class="error-form">', '</span><br/><br/>'); ?>  
							 	<div class="row">
							 		<div class="col-lg-6">
							 			<?php
							 			$data = array(
							 				'name'  => 'perfil',
							 				'id'    => 'perfil',
							 				'class' => 'form-control selectpicker',
							 				'data-style' => 'btn-primary'
							 				);
							 			$opciones = (array)$perfiles;                               
							 			echo form_dropdown($data, $opciones, set_value('perfil'));                              
							 			?>
							 		</div>
							 	</div> 
							 </div>
							 <!-- end : perfil -->

							 <!-- begin : estado --> 
							 <div class="form-group">
							 	<label for="estado">Estado</label>
							 	<?php echo form_error('estado', '<span class="error-form">', '</span><br/><br/>'); ?>  
							 	<div class="row">
							 		<div class="col-lg-3">
							 			<?php
							 			if(set_value('estado') == HABILITADO OR set_value('estado')== null)
							 				$class = 'btn-success';
							 			else
							 				$class='btn-danger'; 

							 			$data = array(
							 				'name'  => 'estado',
							 				'id'    => 'estado',
							 				'class' => 'form-control selectpicker',
							 				'data-style' => $class
							 				);
							 			$opciones = array(
							 				HABILITADO  => 'Habilitado',
							 				DESHABILITADO  => 'Deshabilitado'
							 				);               
							 			echo form_dropdown($data, $opciones, set_value('estado'));                               
							 			?>
							 		</div>
							 	</div> 
							</div>                          
							<!-- end : estado -->
							<div class="box-footer">
							 	<input type="hidden" name="guardar" id="guardar" value="<?php echo NUEVO; ?>" />
							 	<a href="#" class="btn btn-default">Cancelar</a>
							 	<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</form>
				</div>
			</div>
			<!-- /.box -->
		</div>
		<!-- /.col-->
	</div>
	<!-- ./row -->
</section>
<!-- /.content -->
<?php $this->load->view('backend/template/footer'); ?>