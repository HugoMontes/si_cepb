<?php require_once("../../config/config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Login Page 2 | Creative - Bootstrap 3 Responsive Admin Template</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo BASE_URL; ?>assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="<?php echo BASE_URL; ?>assets/js/html5shiv.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form" action="<?php echo BASE_URL; ?>controller/LoginDispatcher.php" method="POST">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Nombre de usuario" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" placeholder="Contraseña">
            </div>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> Recuérdame
                <span class="pull-right"> <a href="#"> ¿Se ha olvidado su contraseña?</a></span>
            </label>
            <input type="hidden" name="action" value="login"/>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar Sesión</button>
        </div>
      </form>

    </div>


  </body>
</html>
