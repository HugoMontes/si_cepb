<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CEPB | Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo bg-teal-active color-palette">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>anel</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>CEPB</b> Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top bg-teal-active color-palette">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle bg-teal-active color-palette" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu bg-teal-active color-palette">
        <ul class="nav navbar-nav">
            
         
          <!-- User Account: style can be found in dropdown.less NOMBRE DE LA CUENTA EN USO-->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Sistema de Información Empresarial</span>
            </a>
            
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>


  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU</li>
        
       <!--menu de opciones para los reportes-->
        <li>
          <a href="pages/historicos/historicos0.php">
            <i class="fa fa-line-chart"></i> <span>Indicadores Historicos</span>
            
          </a>
        </li>
        <li>
          <a href="vacio.php">
            <i class="fa fa-street-view"></i> <span>Indicadores de Coyuntura</span>
            
          </a>
        </li>
        <li>
          <a href="vacio.php">
            <i class="fa fa-map-o"></i> <span>Indicadores Internacionales</span>
          </a>
        </li>
    <!--   /menu de opciones para los reportes-->
  
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">




    <!-- Content Header (Page header) titulo de la pagiona proncipal -->
    
    <form action="#" method="POST">
<section class="content">

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        
        <!-- /.box-header -->
        <!-- form start 
        <form role="form">-->

          <div class="box-body">
     <!--cuadros-->
     <section id="services" class="bg-teal-active color-palette">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-11 col-lg-offset-0">
                    <h2>CONSULTAS</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 fade" style="cursor: pointer;">
                        
                            <div class="service-item">
                            
                                <span class="fa-stack fa-4x">
<!--                               <img src="img/img1.jpg" alt="User Image"> -->
                            </span>
                                <h4>
                                    <strong>Indicadores Historicos</strong>
                                </h4>
                                <p></p>
                                <a href="pages/historicos/historicos0.php" class="btn btn-block btn-primary btn-xs">CONSULTAR GRAFICO</a>
                                
                            </div>
                            
                        </div>
                        <div class="col-md-4 col-sm-6 fade" style="cursor: pointer;">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
<!--                                <img src="img/img2.jpg" alt="User Image"> -->
                            </span>
                                <h4>
                                    <strong>Indicadores de Coyuntura</strong>
                                </h4>
                                <p></p>
                                <a href="vacio.php" class="btn btn-block btn-primary btn-xs">CONSULTAR GRAFICO</a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 fade" style="cursor: pointer;">
                            <div class="service-item">
                                <span class="fa-stack fa-4x">
<!--                                <img src="img/img3.jpg" alt="User Image"> -->
                            </span>
                                <h4>
                                    <strong>Indicadores Internacionales</strong>
                                </h4>
                                <p></p>
                                <a href="vacio.php" class="btn btn-block btn-primary btn-xs">CONSULTAR GRAFICO</a><p></p>
                            </div>
                        </div>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
        </div>

    </section>


</div>
        </div>
</form>
<section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body" style="display: block;">
          <h1></h1>
        </div>
      </div>
      <!-- /.box -->

    </section>
          <!-- /.box-body -->

          
          
          <!-- /.box-footer 
        
        </form>-->
      </div>
      <!-- /.box -->
</div>
    <!--/.col (left) -->
</div>
  <!-- /.row -->


</section>
</form> 

  </div>
  <!-- /.content-wrapper -->


  
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2016 <a href="http://www.cepb.org.bo/">Confederación de Empresarios Privados de Bolivia</a>. </strong>| cepb@cepb.org.bo     All rights
    reserved.
  </footer>



</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
<style type="text/css">
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
 font-family: Arial }
</style>
<style type="text/css">
.fade { opacity:1; } 
.fade:hover { opacity:0.5; }
</style>
