<!DOCTYPE html>
<html lang="en">
<head>
<title>Smart Login Form Responsive Widget Template:: W3layouts</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="<?php echo base_url();?>resources/css/style-login.css" rel="stylesheet" type="text/css" media="all">
<!-- FontAwesome Styles-->
<link href="<?php echo base_url();?>resources/assets/css/font-awesome.css" rel="stylesheet" />
<!-- Bootstrap Styles-->
<link href="<?php echo base_url();?>resources/assets/css/bootstrap.css" rel="stylesheet" />
<!--//online-fonts -->
<body style="background-color: black !important;">
    <div class="container-form">
        <!--header-->
        <div class="agileheader">
            <h1>SIE CEPB</h1>
        </div>
        <!--//header-->

        <!--main-->
        <div class="main-w3l">
            <div class="w3layouts-main" style="background: rgba(0, 74, 132, 0.43);">
                <h2>Iniciar sesión</h2>
                <!-- inicio cuadro mensaje -->         
                    <?php if (isset($error)) { ?>                
                      <div class="alert alert-block alert-danger fade in">
                        <h4><i class="icon fa fa-ban"></i> ¡Error!</h4>       
                        <?php echo $error;?>
                      </div>          
                      <?php  $this->session->unset_userdata('error'); ?>
                    <?php } ?>
                <!-- fin cuadro mensaje  --> 
                <form action="<?php echo base_url(); ?>index.php/backend/login" method="post">
                    <input value="" name="usuario" type="text" value="<?php echo set_value('usuario');?>" required="" placeholder="Nombre de usuario" />
                    <?php echo form_error('usuario', '<span class="error-form">', '</span>'); ?>
                    <input value="" name="password" type="password" required="" placeholder="Contraseña" />
                    <?php echo form_error('password', '<span class="error-form">', '</span>'); ?>
                    <span><input type="checkbox" name="remember" value="1"/>Recuérdame</span>
                    <div class="clear"></div>
                    <input type="submit" value="INICIAR SESIÓN" name="login">
                </form>
            </div>
        </div>
        <!--//main-->
    </div>
</body>
</html>
