<?php $this->load->view('backend/template/header'); ?>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- inicio cuadro mensaje -->  
			<input type="hidden" name="accion_eliminar" id="accion_eliminar" value="<?php echo base_url('index.php/administrador/usuario/eliminar');?>" />
			<input type="hidden" name="accion_habilitar" id="accion_habilitar" value="<?php echo base_url('index.php/administrador/usuario/habilitar');?>" />
			<input type="hidden" name="accion_habilitar_mensaje" id="accion_habilitar_mensaje" value="<?php echo base_url('index.php/administrador/usuario/habilitar_mensaje');?>" />
			<div id="contenido_ajax">
				<?php if (isset($mensaje)) { ?>
					<div class="callout callout-success">
						<h4>Mensaje</h4>
						<p><?php echo $mensaje;?></p>
					</div>
				<?php    
					$this->session->unset_userdata('mensaje');
				} elseif (isset($error)) {
					?>                
					<div class="callout callout-danger">
						<h4>Error</h4>

						<p><?php echo $error;?></p>
					</div>          
					<?php
					$this->session->unset_userdata('error');
				}?>                
			</div>              

			<!-- fin cuadro mensaje  -->                
			<div class="panel panel-default">
  				<div class="panel-body"> 
						<div class="form-group">
							<div class="row">
								<div class="col-lg-8 margin-top-normal">
									<div class="input-group">
										<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $buscar; ?>" placeholder="<?php echo $this->lang->line('score_buscar');?>"/>
										<span class="input-group-btn">
											<a id="buscar-apellidos" href="" class="btn btn-primary" onclick="buscar_apellidos('<?php echo base_url('index.php/administrador/usuario');?>');"><i class="fa fa-search"></i>&nbsp; Buscar</a>
										</span>
										<span class="input-group-btn">
											<a href="<?php echo base_url('index.php/backend/usuario'); ?>" class="btn btn-default" style="margin-left: 10px;"> Limpiar</a>
										</span>
										<div class="margin-left-normal">                                                                                                                                         
											<?php
											$data = array(
												'name'  => 'perfil',
												'id'    => 'perfil',
												'class' => 'form-control'
												);
											$opciones = (array)$perfiles;                               
											$evento = "'".base_url('index.php/backend/usuario')."'" ;
											echo form_dropdown($data, $opciones, set_value('perfil',$opcion_perfil),'onChange="buscar_perfil('.$evento.')"');                              
											?>
										</div>
									</div>  
								</div>
							</div>                               
						</div>

				<!-- /.box-header -->
                                       
					<div class="clr"></div>
					<!-- inicio tabla -->
					<div id="browse_table">
						<p style="text-align: right;" class="results">P&aacute;gina  <?php echo $pagina_actual; ?> de <?php echo $pagina_total; ?></p> 
						<table id="browse_table" class="table table-hover table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
							<thead>
								<tr class="headers">
									<th class="first" scope="col"><div>Apellidos <?php /* ?> <ul class="sort"><li class="up"><?php echo $this->page->create_sort_link('apellidos', 'asc'); ?></li><li class="down"><?php echo $this->page->create_sort_link('apellidos', 'desc'); ?></li></ul></div><?php */ ?></th>
									<th scope="col">Nombres</th>
									<th scope="col">Usuario</th>
									<!--th scope="col">Correo electrónico</th-->
									<th scope="col">Perfil</th>
									<th scope="col">Fecha de la última visita</th>
									<th scope="col">Fecha de registro</th>
									<th scope="col" class="col-id" style="text-align: center;">ID</th>
									<th scope="col" class="col-estado" style="text-align: center;">Estado</th>
									<th scope="col" class="col-opciones" style="text-align: center;">Opciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if(count($usuarios)>0)
								{
									foreach ($usuarios as $usuario):
										$usuario = (object) $usuario;
									?>
									<tr>
										<td class="row-title"><a href="<?php echo base_url('index.php/administrador/usuario/editar/'.$usuario->id);?>" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('score_editar_tooltip'); ?>"><?php echo $usuario->apellidos?></a></td>                          
										<td class="row-title"><a href="<?php echo base_url('index.php/administrador/usuario/editar/'.$usuario->id);?>" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('score_editar_tooltip'); ?>"><?php echo $usuario->nombres?></a></td>                         
										<td><?php echo $usuario->usuario; ?></td>
										<!--td><?php echo $usuario->email; ?></td-->
										<td>
											<?php 
											if($this->perfil_model->exists('id',$usuario->perfil))
											{
												$perfil = $this->perfil_model->get_values('nombre',array('id'=>$usuario->perfil));
												echo $perfil->nombre;                            
											}
											else
												echo '';                            
											?>
										</td>
										<td>
											<?php 
											if($usuario->ultima_visita == '0000-00-00 00:00:00')
												echo 'Nunca';
											else
												echo $usuario->ultima_visita;
											?>
										</td>
										<td><?php echo $usuario->creado?></td>
										<td style="text-align: center;"><?php echo $usuario->id?></td>
										<td style="text-align: center;"> 
											<div id="contenido_ajax_<?php echo $usuario->id; ?>">
												<?php
												/*
												if($usuario_sesion->id == $usuario->id){
													$tooltip_deshabilitar = $this->lang->line('score_usuario_error_deshabilitar');
													$class_disabled = 'disabled';
												}else{
													$tooltip_deshabilitar = $this->lang->line('score_deshabilitar_tooltip');
													$class_disabled = '';
												}
												if($usuario->estado == HABILITADO){ ?>
													<a href="javascript:;" onclick="habilitar(<?php echo $usuario->id;?>)" class="btn btn-success btn-xs <?php echo $class_disabled;?>" data-toggle="tooltip" data-placement="top" title="<?php echo $tooltip_deshabilitar; ?>"><i class="fa fa-check-circle"></i></a>
												<?php }else{ ?>
													<a href="javascript:;" onclick="habilitar(<?php echo $usuario->id;?>)" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="<?php echo $this->lang->line('score_habilitar_tooltip');?>"><i class="fa fa-times-circle"> </i></a>
												<?php }	*/?>
											</div>                                 
										</td>
										<td style="text-align: center;">                      
											<div class="btn-group">
												<a href="<?php echo base_url('index.php/administrador/usuario/editar/'.$usuario->id);?>" class="btn btn-default" data-container="body" data-toggle="tooltip"  data-placement="top" title="<?php echo $this->lang->line('score_editar_tooltip'); ?>"><i class="fa fa-pencil"></i></a>
												<a href="javascript:;" onclick="eliminar(<?php //echo $usuario->id; ?>,'<?php echo $usuario->nombres." ".$usuario->apellidos; ?>')" class="btn btn-default <?php //echo $class_disabled;?>" data-container="body" data-toggle="tooltip"  data-placement="top" title="<?php //echo $this->lang->line('score_eliminar_tooltip'); ?>"><i class="fa fa-trash-o"></i></a>
											</div>
										</td>
									</tr>
									<?php
									endforeach;
								}
								else
								{
									?>
									<tr>
										<td colspan="10">Lo sentimos, no hay registros.</td>
									</tr>                       
									<?php    
								}
								?>
							</tbody>
						</table>
						<div style="text-align: center;">
							<?php echo $this->pagination->create_links(); ?>
						</div>
					</div>      
					<!-- fin tabla -->
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