  <?php $usuario_sesion = get_user_session(); ?>
  <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav" id="main-menu">

        <li>
          <a class="active-menu" href="<?php echo base_url('index.php/backend/escritorio'); ?>"><i class="fa fa-dashboard"></i> Escritorio</a>
        </li>
        <li>
          <a href="ui-elements.html"><i class="fa fa-bar-chart-o"></i> Historicos<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="<?php echo base_url('index.php/backend/historico'); ?>">Indicadores</a>
            </li>
            <!--li>
              <a href="#">Nuevo indicador</a>
            </li-->
          </ul>
        </li>
        <li>
          <a href="chart.html"><i class="fa fa-bar-chart-o"></i> Coyuntura<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="<?php echo base_url('index.php/backend/coyuntura'); ?>">Indicadores</a>
            </li>
            <!--li>
              <a href="#">Nuevo indicador</a>
            </li-->
          </ul>
        </li>
        <li>
          <a href="tab-panel.html"><i class="fa fa-bar-chart-o"></i> Internacional<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="<?php echo base_url('index.php/backend/internacional'); ?>">Indicadores</a>
            </li>
            <!--li>
              <a href="#">Nuevo indicador</a>
            </li-->
          </ul>
        </li>

        <li>
          <a href="#"><i class="glyphicon glyphicon-download-alt"></i> Area de subida de información<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="#">Historico</a>
            </li>
            <li>
              <a href="#">Coyuntura</a>
            </li>
            <li>
              <a href="#">Internacional</a>
            </li>
          </ul>
        </li>
        
        <!--
        <li>
          <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="#">Second Level Link</a>
            </li>
            <li>
              <a href="#">Second Level Link</a>
            </li>
            <li>
              <a href="#">Second Level Link<span class="fa arrow"></span></a>
              <ul class="nav nav-third-level">
                <li>
                  <a href="#">Third Level Link</a>
                </li>
                <li>
                  <a href="#">Third Level Link</a>
                </li>
                <li>
                  <a href="#">Third Level Link</a>
                </li>

              </ul>

            </li>
          </ul>
        </li>
        -->

        <li>
          <a href="#"><i class="fa fa-user"></i> Usuarios<span class="fa arrow"></span></a>
          <ul class="nav nav-second-level">
            <li>
              <a href="<?php echo base_url('index.php/backend/usuario'); ?>">Todos los usuarios</a>
            </li>
            <li>
              <a href="<?php echo base_url('index.php/backend/usuario/nuevo'); ?>">Añadir nuevo</a>
            </li>
            <li>
              <a href="<?php echo base_url('index.php/backend/usuario/editar/'.$usuario_sesion->id); ?>">Tu perfil</a>
            </li>
          </ul>
        </li>

        <li>
          <a href="<?php echo base_url('index.php/backend/logout'); ?>"><i class="glyphicon glyphicon-log-out"></i> Cerrar sesión</a>
        </li>
      </ul>

    </div>

  </nav>
        <!-- /. NAV SIDE  -->