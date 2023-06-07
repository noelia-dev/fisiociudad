<nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow top-barra">
    <div class="mx-auto d-flex justify-content-center d-sm-none" style="width: 100%;">
        <?= $this->Html->image('logo_horizontal.jpg', ['alt' => 'Fisiociudad', 'class' => 'nav-logo']) ?>
    </div>
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <!-- li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            < !-- Dropdown - Messages -- >
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li -->

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline small"><?= $login_nombre ?></span>
                <?= $this->Html->image('perfil.jpg', ['alt' => 'miperfil', 'class' => 'img-profile rounded-circle']) ?>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php $clases = str_contains($menu_activo, 'editadmin') ? 'active' : ''; ?>
                <?= $this->Html->link(
                    "<i class='fas fa-user fa-sm fa-fw mr-2 text-gray-400'></i>Perfil",
                    ['controller' => 'Usuarios', 'action' => 'editadmin', $id_login],
                    ['class' => 'dropdown-item ' . $clases, 'escape' => false]
                ); ?>
                <?php $clases = str_contains($menu_activo, 'adminpass') ? 'active' : ''; ?>
                <?= $this->Html->link(
                    '<i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>Modificar contraseña',
                    ['controller' => 'Usuarios', 'action' => 'adminpass', $id_login],
                    ['class' => 'dropdown-item ' . $clases, 'escape' => false]
                ); ?>

                <!-- a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Perfil
                </a-->
                <!-- <a class="dropdown-item" href="#">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Configuración
                </a-->
                <!--<a class="dropdown-item" href="#">
                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                    Activity Log
                </a>-->
                <div class="dropdown-divider"></div>
                <?= $this->Html->link(
                    '<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Cerrar sesión',
                    [
                        'controller' => 'Usuarios', 'action' => 'logout'
                    ],
                    ['class' => 'dropdown-item', 'escape' => false]
                ); ?>

            </div>
        </li>
    </ul>
</nav>