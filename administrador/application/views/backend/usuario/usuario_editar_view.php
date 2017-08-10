<?php $this->load->view('backend/template/header'); ?>

<div class="row">
	<div class="col-lg-12">
		<form class="form-validate " enctype="multipart/form-data"  method="post" action="<?php echo base_url('index.php/backend/usuario/guardar');?>">
		<section class="panel panel-default">
			<div class="panel-body">
				 <!-- inicio cuadro mensaje -->                
                <?php if(isset($mensaje)) { ?>
	                <div class="alert alert-success fade in">
	                    <strong>MENSAJE</strong>	                
	                    <p><?php echo $mensaje;?></p>
	                </div>
                <?php    
                	$this->session->unset_userdata('mensaje');
                }elseif(isset($error)) { ?>                
	                <div class="alert alert-block alert-danger fade in">
	                    <strong>ERROR</strong>
	                    <?php echo $error;?>
	                </div>          
                <?php
                	$this->session->unset_userdata('error');
                } ?>
                <!-- fin cuadro mensaje  -->
	
					<div class="form-group col-sm-7">
						<label>Nombre de usuario *</label>
						<input type="text" class="form-control" name="usuario" value="<?php echo set_value('usuario', $usuario->usuario);?>" placeholder="Nombre de usuario">
						<?php echo form_error('usuario', '<label class="error">', '</label>'); ?>
					</div>

					<div class="form-group col-sm-7">
						<label>Correo electrónico *</label>						
						<input type="text" class="form-control" name="email" value="<?php echo set_value('email', $usuario->email);?>" placeholder="Correo electrónico">
						<?php echo form_error('email', '<label class="error">', '</label>'); ?>
					</div>

					<div class="form-group col-sm-7">
						<label>Nombres *</label>
							<input type="text" class="form-control" name="nombres" value="<?php echo set_value('nombres',$usuario->nombres);?>" placeholder="Nombres">
                        	<?php echo form_error('nombres', '<label class="error">', '</label>'); ?>
					</div>

					<div class="form-group col-sm-7">
						<label>Apellidos *</label>
							<input type="text" class="form-control" name="apellidos" value="<?php echo set_value('apellidos', $usuario->apellidos);?>" placeholder="Apellidos">
                        	<?php echo form_error('apellidos', '<label class="error">', '</label>'); ?>
					</div>


					<?php if(!empty($usuario->fotografia)){
						$label_fotografia = 'Cambiar fotografía';  
					?>
						<div id="vista_previa" class="form-group">
							<label for="vista_previa">Fotografía</label>
							<br/><a class="btn btn-danger" href="javascript:remover_fotografia();">Remover fotografía</a>         
							<div class="margin-bottom">
								<img class="img-responsive img-centro" src="<?php echo base_url('resources/img/usuarios/'.$usuario->fotografia); ?>" alt="<?php echo $usuario->fotografia;?>"/>                                  
							</div>
						</div>
					<?php }else{
						$label_fotografia = 'Fotografía';
					} ?>

					<div class="form-group col-sm-7">
						<label><?php echo $label_fotografia; ?></label>
						<input type="file" name="fotografia" />                
                        <p class="help-block" style="padding-top: 0px; font-size: 14px;">Formatos aceptados: gif, jpg, png, jpeg  (Tamaño máximo 128 kb)</p>
					</div>

					<div class="form-group col-sm-7">
						<label>Nueva contraseña</label>
						<input type="password" name="password" class="form-control">
					</div>
					
					<div class="form-group col-sm-7">
						<label>Perfil</label>  
						<div>
							<?php
								$data = array(
									'name'  => 'perfil',
									'id'    => 'perfil',
									'class' => 'form-control selectpicker',
									'data-style' => 'btn-primary'
									);
								$opciones = (array)$perfiles;                               
								echo form_dropdown($data, $opciones, set_value('perfil',$usuario->perfil));                              
							?>
						</div> 
					</div> 


					<div class="form-group col-sm-7">
						<label>Estado</label>
						<div>
							<?php
								if(set_value('estado', $usuario->estado) == HABILITADO){
									$class = 'btn-success';
								}else{
									$class='btn-danger'; 
								}
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
								echo form_dropdown($data, $opciones, set_value('estado', $usuario->estado));                               
							?>
						</div> 
					</div> 

					<input type="hidden" name="fotografia" id="fotografia" value="<?php echo $usuario->fotografia; ?>"/>
                    <input type="hidden" name="fotografia_thumb" id="fotografia_thumb" value="<?php echo $usuario->thumb;?>"/>
                    <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario->id;?>" />
					<input type="hidden" name="guardar" id="guardar" value="<?php echo EDICION; ?>" />
					
				
			</div>
			<div class="panel-footer">
						<a href="<?php echo base_url('index.php/backend/escritorio'); ?>" class="btn btn-default">Cancelar</a>
		              	<button type="submit" class="btn btn-primary">Guardar</button>
	              	</div>
		</section>
		</form>
	</div>
</div>

<?php $this->load->view('backend/template/footer'); ?>