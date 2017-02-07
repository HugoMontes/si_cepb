<?php require_once("../../config/config.php"); ?>
<?php require_once("../template/header.php"); ?>
  <section class="content-header">
      <!--<h1>
      Sistema de informacion Economica
      </h1>-->
  </section>

  <section class="content">
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">
          <!-- general form elements -->
              <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Glosario de términos estadísticos</h3>
                    <button id="showhidehelp" class="btn btn-success btn-sm pull-right"><i class="fa fa-question-circle"></i>&nbsp;&nbsp;Abreviaturas utilizadas</button>
                  </div>
                  <!-- inicio de ayuda -->
                  <div id="help" class="contextual-help-simple col-md-12" style="display: none;">
                    <p><strong>Abreviaturas utilizadas en este glosario: </strong></p>
                    <table>
                    	<tr><td>adj.</td><td style="padding-left: 10px;">adjetivo</td></tr>
                        <tr><td>f.</td><td style="padding-left: 10px;">sustantivo femenino</td></tr>
                        <tr><td>m.</td><td style="padding-left: 10px;">sustantivo masculino</td></tr>
                        <tr><td>pal.rel.</td><td style="padding-left: 10px;">palabra relacionada</td></tr>
                        <tr><td>pas.part.</td><td style="padding-left: 10px;">pasado participio</td></tr>
                        <tr><td>pl.</td><td style="padding-left: 10px;">plural</td></tr>
                        <tr><td>u.c.</td><td style="padding-left: 10px;">usado como</td></tr>
                        <tr><td>u.m.</td><td style="padding-left: 10px;">unidad de medida</td></tr>
                        <tr><td>u.t.c.</td><td style="padding-left: 10px;">usado también como</td></tr>
                        <tr><td>var.</td><td style="padding-left: 10px;">variante</td></tr>
                    </table>
                  </div>        
                  <!-- fin de ayuda -->                  
                  <div class="box-body">
                  <!-- inicio glosario -->
                <?php 
                    function get_palabras($letra = FALSE)
                    {
                        $NOMBRE_TABLA_GLOSARIO = 'glosario';
                        if($letra == FALSE)
                            $letra == 'A';
                        
                        include 'conexion_bd.php';
                    	$sql = "SELECT `concepto`, `significado`   
                		FROM ".$NOMBRE_TABLA_GLOSARIO." 
                        WHERE concepto like '".$letra."%' COLLATE utf8_spanish_ci";	
                		mysql_query("set names 'utf8'");  
                		$registros = mysql_query($sql) or die ("Error al obtener los registros del glosario: ".mysql_error());
                		$palabras = array();
                        while($fila = mysql_fetch_array($registros))
                		{
                            $palabras[] = array('concepto'=>$fila['concepto'],'significado'=>$fila['significado']);
                		}
                        return $palabras;
                    }
                ?>
                <?php
                    $abecedario = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','W','X','Y','Z');
                    
                    $letra = strtoupper($_GET['letra']);
                    if(empty($letra))
                        $letra = 'A';
                        
                    $palabras = get_palabras($letra);    
                ?>    
                    <div class="col-xs-12" align="center">
                        <nav>
                          <ul class="pagination pagination-lg">
                            <?php
                            for($i=0;$i<count($abecedario);$i++)
                            {
                                $class_activo = '';
                                if($abecedario[$i]== $letra)
                                     $class_activo = 'active';        
                            ?>
                            <li class="<?php echo $class_activo; ?>"><a href="glosario.php?letra=<?php echo $abecedario[$i];?>"><?php echo $abecedario[$i];?> <span class="sr-only">(current)</span></a></li>
                            <?php    
                            }
                            ?>
                          </ul>
                        </nav>
                    </div>
                    <div class="col-xs-12" style="background-color: #196791;" align="center">
                        <h3 style="color: #FFF;"><?php echo $letra;?></h3>
                    </div>
                    
                    <?php
                    foreach($palabras as $palabra):
                        $palabra = (object)$palabra;
                    ?>
                        <div class="col-xs-12" style="margin-top: 10px;">
                            <p><strong><?php echo $palabra->concepto;?></strong></p>
                            <div style="padding-left: 30px;"><?php echo $palabra->significado;?></div>    
                        </div>    
                    <?php    
                    endforeach;
                    
                    if(count($palabras) > 0)
                    {
                    ?>
                        <div class="col-xs-12" style="margin-top: 10px;">
                            <p><a href="#glosario_top" style="text-decoration: none;">Volver arriba</a></p> 
                        </div>       
                    <?php    
                    }
                    ?>                
                  <!-- fin glosario -->  
                  </div>
              </div>
          </div>
      </div>
  </section>
<?php require_once("../template/footer.php"); ?>