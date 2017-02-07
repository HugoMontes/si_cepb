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

    <title>Creative - Bootstrap Admin Template</title>

    <!-- Bootstrap CSS -->    
    <link href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="<?php echo BASE_URL; ?>assets/css/elegant-icons-style.css" rel="stylesheet" />
    <link href="<?php echo BASE_URL; ?>assets/css/font-awesome.min.css" rel="stylesheet" />    
    <!-- full calendar css-->
    <link href="<?php echo BASE_URL; ?>assets/assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/assets/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" />
    <!-- easy pie chart-->
    <link href="<?php echo BASE_URL; ?>assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/owl.carousel.css" type="text/css">
	<link href="<?php echo BASE_URL; ?>assets/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <!-- Custom styles -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/fullcalendar.css">
	<link href="<?php echo BASE_URL; ?>assets/css/widgets.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/style.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>assets/css/style-responsive.css" rel="stylesheet" />
	<link href="<?php echo BASE_URL; ?>assets/css/xcharts.min.css" rel=" stylesheet">	
	<link href="<?php echo BASE_URL; ?>assets/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="<?php echo BASE_URL; ?>assets/js/html5shiv.js"></script>
      <script src="<?php echo BASE_URL; ?>assets/js/respond.min.js"></script>
      <script src="<?php echo BASE_URL; ?>assets/js/lte-ie7.js"></script>
    <![endif]-->
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
      	#HEADER#
      </header>      
      <!--header end-->

      <!--sidebar start-->
      <aside>
		#MENULEFT#          
      </aside>
      <!--sidebar end-->
      
      <!--main content start-->
      <section id="main-content">
      	#CONTENIDO#
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

    <!-- javascripts -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery-ui-1.10.4.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
    <!-- bootstrap -->
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- charts scripts -->
    <script src="<?php echo BASE_URL; ?>assets/assets/jquery-knob/js/jquery.knob.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo BASE_URL; ?>assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/owl.carousel.js" ></script>
    <!-- jQuery full calendar -->
    <<script src="<?php echo BASE_URL; ?>assets/js/fullcalendar.min.js"></script> <!-- Full Google Calendar - Calendar -->
	<script src="<?php echo BASE_URL; ?>assets/assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="<?php echo BASE_URL; ?>assets/js/calendar-custom.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.customSelect.min.js" ></script>
	<script src="<?php echo BASE_URL; ?>assets/assets/chart-master/Chart.js"></script>
   
    <!--custome script for all page-->
    <script src="<?php echo BASE_URL; ?>assets/js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="<?php echo BASE_URL; ?>assets/js/sparkline-chart.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/easy-pie-chart.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/xcharts.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.autosize.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.placeholder.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/gdp-data.js"></script>	
	<script src="<?php echo BASE_URL; ?>assets/js/morris.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/sparklines.js"></script>	
	<script src="<?php echo BASE_URL; ?>assets/js/charts.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.slimscroll.min.js"></script>
  <script>

      //knob
      $(function() {
        $(".knob").knob({
          'draw' : function () { 
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
          $("#owl-slider").owlCarousel({
              navigation : true,
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem : true

          });
      });

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });
	  
	  /* ---------- Map ---------- */
	$(function(){
	  $('#map').vectorMap({
	    map: 'world_mill_en',
	    series: {
	      regions: [{
	        values: gdpData,
	        scale: ['#000', '#000'],
	        normalizeFunction: 'polynomial'
	      }]
	    },
		backgroundColor: '#eef3f7',
	    onLabelShow: function(e, el, code){
	      el.html(el.html()+' (GDP - '+gdpData[code]+')');
	    }
	  });
	});



  </script>

  </body>
</html>
