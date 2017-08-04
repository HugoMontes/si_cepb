<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo BASE_URL; ?>img/favicon.png">
  <title>CEPB</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/morris/morris.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Styles CEPB -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style-cepb-backend.css">
</head>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

  <div class="content-wrapper">
    <div class="box-body">
      <!-- inicio navegacion -->
      <section id="services" class="bg-teal-active color-palette">
        <div class="container">        
          <div class="row text-center">
            <!-- inicio botones navegacion -->
            <div class="row">
              <a href="<?php echo BASE_URL; ?>" class="title">
                <h2>SISTEMA DE INFORMACIÓN ECONÓMICA</h2>
              </a>
              <hr class="small"/>
              
              <div>
                  <a href="<?php echo BASE_URL; ?>pages/historicos/historicos.php" class="btn btn-sq-lg btn-primary col-xs-12 col-sm-2 col-centered">
                    <i class="fa fa-line-chart fa-5x"></i><br/>
                    Indicadores <br/>Historicos
                  </a>
                  <a href="<?php echo BASE_URL; ?>pages/historicos/coyuntura.php" class="btn btn-sq-lg btn-primary col-xs-12 col-sm-2 col-centered">
                    <i class="fa fa-area-chart fa-5x"></i><br/>
                    Indicadores de <br/>Coyuntura
                  </a>
                  <a href="<?php echo BASE_URL; ?>pages/historicos/internacionales.php" class="btn btn-sq-lg btn-primary col-xs-12 col-sm-2 col-centered">
                    <i class="fa fa-globe fa-5x"></i><br/>
                    Indicadores <br/>Internacionales
                  </a>
                  <a href="<?php echo BASE_URL; ?>pages/historicos/combinaciones.php" class="btn btn-sq-lg btn-primary col-xs-12 col-sm-2 col-centered">
                    <i class="fa fa-random fa-5x"></i><br/>
                    Combinación de<br />Indicadores
                  </a>
                  <a href="<?php echo BASE_URL; ?>pages/historicos/comparativa.php" class="btn btn-sq-lg btn-primary col-xs-12 col-sm-2 col-centered">
                    <i class="fa fa-exchange fa-5x"></i><br/>
                    Comparativa de<br/>Indicadores
                  </a>      
                  <a href="<?php echo BASE_URL; ?>pages/glosario/glosario.php?letra=a" class="btn btn-sq-lg btn-primary col-xs-12 col-sm-2 col-centered">
                    <i class="fa fa-book fa-5x"></i><br/>
                    Glosario<br />estadístico
                  </a>                           
              </div>
              <br/>
            </div>              
            <!-- fin botones navegacion -->              
          </div>
        </div>
      </section>
      <!--fin navegacion-->
    </div>