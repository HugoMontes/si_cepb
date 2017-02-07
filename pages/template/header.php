<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <style>
    body {
      font-family:Arial;
    }
    .eldiv { 
      width: 483px; 
      height: 168px; 
      background: #ffffff; 
      transition: all 0.3s ease; 
      color: #ffffff; 
      text-align: center;
      padding-top: 130px; 
      font-size: 2em; 
      font-weight: bold; 
      font-family: Arial
    }

    .fade { opacity:1; } 
    .fade:hover { opacity:0.5; }

    .btn-sq-lg {
      margin-right: 10px;margin-left: 10px;
    }

    .modal {
      display:    none;
      position:   fixed;
      z-index:    1000;
      top:        0;
      left:       0;
      height:     100%;
      width:      100%;
      background: rgba( 255, 255, 255, .8 ) 
      url('http://i.stack.imgur.com/FhHRx.gif') 
      50% 50% 
      no-repeat;
    }

    /* When the body has the loading class, we turn
       the scrollbar off with overflow:hidden */
    body.loading {
      overflow: hidden;   
    }

    /* Anytime the body has the loading class, our
       modal element will be visible */
    body.loading .modal {
      display: block;
    }

    .col-centered{
      float: none;
      margin: 0 auto;
    }
    .btn-sq-lg{
      width: 150px;
    }
  </style>
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
              <h2>SISTEMA DE INFORMACIÓN ECONÓMICA</h2>
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