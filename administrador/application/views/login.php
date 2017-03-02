<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Hugo Montes">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>resources/img/favicon.png">

    <title>Iniciar Sesion</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo base_url(); ?>resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo base_url(); ?>resources/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo base_url(); ?>resources/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>resources/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo base_url(); ?>resources/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>resources/css/style-responsive.css" rel="stylesheet" />

    <link href="<?php echo base_url(); ?>resources/css/backend-login.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
  <body class="login-img3-body">
    <div class="container">
      
      <form class="login-form" action="<?php echo base_url(); ?>index.php/backend/login" method="post">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <!-- inicio cuadro mensaje -->         
            <?php if (isset($error)) { ?>                
              <div class="alert alert-block alert-danger fade in">
                <h4><i class="icon fa fa-ban"></i> ¡Error!</h4>       
                <?php echo $error;?>
              </div>          
              <?php  $this->session->unset_userdata('error'); ?>
            <?php } ?>
            <!-- fin cuadro mensaje  --> 
            <div class="input-group" style="padding-bottom: 0px; padding-top: 15px;">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" name="usuario" class="form-control" value="<?php echo set_value('usuario');?>" placeholder="Nombre de usuario" autofocus>
            </div>
            <?php echo form_error('usuario', '<span class="error-form">', '</span>'); ?>

            <div class="input-group" style="padding-bottom: 0px; padding-top: 15px;">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="password" class="form-control" value="" placeholder="Contraseña">
            </div>
            <?php echo form_error('password', '<span class="error-form">', '</span>'); ?>

            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"> Recuérdame
            </label>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar sesión</button>
        </div>
      </form>

    </div>
  </body>
</html>
