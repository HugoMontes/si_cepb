  <?php $usuario_sesion = get_user_session(); ?>
  <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav" id="main-menu">

        <li>
          <a href="<?php echo base_url('index.php/backend/escritorio'); ?>" class="<?php echo isset($menu_escritorio)?'active-menu':''; ?>"><i class="fa fa-dashboard"></i> Escritorio</a>
        </li>

        <li>
          <a href="<?php echo base_url('index.php/backend/historico'); ?>" class="<?php echo isset($menu_historico)?'active-menu':''; ?>"><i class="fa fa-line-chart"></i> Historicos</a>
        </li>

        <li>
          <a href="<?php echo base_url('index.php/backend/coyuntura'); ?>" class="<?php echo isset($menu_coyuntura)?'active-menu':''; ?>"><i class="fa fa-area-chart"></i> Coyuntura</a>
        </li>

        <li>
          <a href="<?php echo base_url('index.php/backend/internacional'); ?>" class="<?php echo isset($menu_internacional)?'active-menu':''; ?>"><i class="fa fa-globe"></i> Internacional</a>
        </li>
        
        <!--
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
        -->

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
          <a href="#" class="<?php echo isset($menu_usuario)?'active-menu':'' ?>"><i class="fa fa-user"></i> Usuarios<span class="fa arrow"></span></a>
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