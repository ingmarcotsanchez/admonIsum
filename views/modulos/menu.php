<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo BASE_URL; ?>principal.php" class="brand-link">
      <img src="../html/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">ADMON-ISUM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <input type="hidden" id="usu_idx" value="<?php echo $_SESSION["usu_id"] ?>">
          <input type="hidden" id="rol_idx" value="<?php echo $_SESSION["usu_rol"] ?>">
          <span class="text-muted"><?php echo $_SESSION["usu_nom"]." ".$_SESSION["usu_apep"]." ".$_SESSION["usu_apem"];?></span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">INFORMACIÓN</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>inicio.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Inicio</p>
            </a>
          </li>
          <?php if($_SESSION["usu_rol"] == "C"):?>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>perfil.php" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>Perfil</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admUsuarios.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Usuarios</p>
            </a>
          </li>
          <?php endif; ?>
          
          <li class="nav-header">BÁSICAS</li>
          <?php if($_SESSION["usu_rol"] == "C" || $_SESSION["usu_rol"] == "GA"):?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th text-success"></i>
              <p>
                Docencia
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admProfesor.php" class="nav-link">
                  <i class="fas fa-user-tie text-success nav-icon"></i>
                  <p>Profesores</p>
                </a>
              </li>
              <?php if($_SESSION["usu_rol"] == "C"):?>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admEscalafon.php" class="nav-link">
                  <i class="fas fa-user-graduate text-success nav-icon"></i>
                  <p>Escalafón</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admRol.php" class="nav-link">
                  <i class="fas fa-user-plus text-success nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <?php endif; ?>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admEvaluacion.php" class="nav-link">
                  <i class="fas fa-user-check text-success nav-icon"></i>
                  <p>Evaluación Estudiantes</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if($_SESSION["usu_rol"] == "C" || $_SESSION["usu_rol"] == "GI"):?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th text-warning"></i>
              <p>
                Investigación
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admGrupo.php" class="nav-link">
                  <i class="fas fa-users text-warning nav-icon"></i>
                  <p>Grupos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admLinea.php" class="nav-link">
                  <i class="fas fa-file text-warning nav-icon"></i>
                  <p>Líneas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admSublinea.php" class="nav-link">
                  <i class="fas fa-file text-warning nav-icon"></i>
                  <p>Sub Líneas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admSemilleros.php" class="nav-link">
                  <i class="fas fa-plus-square text-warning nav-icon"></i>
                  <p>Semilleros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admProyectos.php" class="nav-link">
                  <i class="fas fa-copy text-warning nav-icon"></i>
                  <p>Proyectos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admProductos.php" class="nav-link">
                  <i class="fas fa-edit text-warning nav-icon"></i>
                  <p>Productos - Semilleros</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admProductos_profesor.php" class="nav-link">
                  <i class="fas fa-edit text-warning nav-icon"></i>
                  <p>Productos - Profesores</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if($_SESSION["usu_rol"] == "C" || $_SESSION["usu_rol"] == "GA"):?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th text-primary"></i>
              <p>
                Educación
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admSemestre.php" class="nav-link">
                  <i class="fas fa-book text-primary nav-icon"></i>
                  <p>Semestres</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admAsignaturas.php" class="nav-link">
                  <i class="fas fa-address-card text-primary nav-icon"></i>
                  <p>Asignaturas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admEstudiantes.php" class="nav-link">
                  <i class="fas fa-user-graduate text-primary nav-icon"></i>
                  <p>Estudiantes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>admCalificaciones.php" class="nav-link">
                  <i class="fas fa-address-book text-primary nav-icon"></i>
                  <p>Calificaciones</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if($_SESSION["usu_rol"] == "C" || $_SESSION["usu_rol"] == "AU"):?>
          <li class="nav-header">AUTOEVALUACIÓN</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admFactor.php" class="nav-link">
              <i class="nav-icon far fa-calendar-alt text-info"></i>
              <p class="text">Factores</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admAutoevaluacion.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie text-info"></i>
              <p class="text">Autoevaluación</p>
            </a>
          </li>
          <?php endif; ?>
          <li class="nav-header">SOPORTE</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admTikets.php" class="nav-link">
              <i class="nav-icon fas fa-th text-light"></i>
              <p class="text">Tickets</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admNuevoTikets.php" class="nav-link">
              <i class="nav-icon fas fa-plus text-light"></i>
              <p class="text">Crear Ticket</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>admConsultarTikets.php" class="nav-link">
              <i class="nav-icon fas fa-search text-light"></i>
              <p class="text">Consultar Ticket</p>
            </a>
          </li>
          <li class="nav-header">LOGOUT</li>
          <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>Logout.php" class="nav-link">
              <i class="nav-icon fas fa-circle text-danger"></i>
              <p class="text">Salir</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>