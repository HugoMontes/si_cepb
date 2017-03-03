  <?php $usuario_sesion = get_user_session(); ?>
  <nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
      <ul class="nav" id="main-menu">

        <li>
          <a class="active-menu" href="index.html"><i class="fa fa-dashboard"></i> Escritorio</a>
        </li>
        <li>
          <a href="ui-elements.html"><i class="fa fa-desktop"></i> UI Elements</a>
        </li>
        <li>
          <a href="chart.html"><i class="fa fa-bar-chart-o"></i> Charts</a>
        </li>
        <li>
          <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs & Panels</a>
        </li>
        
        <li>
          <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>
        </li>
        <li>
          <a href="form.html"><i class="fa fa-edit"></i> Forms </a>
        </li>

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
          <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>
        </li>
      </ul>

    </div>

  </nav>
        <!-- /. NAV SIDE  -->