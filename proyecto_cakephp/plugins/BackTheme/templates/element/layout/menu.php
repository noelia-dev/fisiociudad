<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Logotipo -->
    <div class="sidebar-brand-icon rotate-n-15 d-flex justify-content-center mt-2">
        <?= $this->Html->image('logo_fisio.png', [
            'alt' => 'FisioCiudad',
            'url' =>  [
                'controller' => 'Usuarios', 'action' => 'index',
            ],
            ['class' => 'sidebar-brand d-flex align-items-center justify-content-center']
        ]) ?>
    </div>
    <?= $this->Html->link(
        ' <div class="sidebar-brand-text mx-3">FisioCiudad<sup>&reg;</sup></div>',
        ['controller' => 'Usuarios', 'action' => 'index'],
        ['class' => 'sidebar-brand d-flex align-items-center justify-content-center', 'escape' => false],
    ); ?>
    <!-- Separador -->
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?= str_contains($menu_activo, 'usuarios') ? 'active' : ''; ?>">
        <!-- Elemento - Usuarios -->
        <?= $this->Html->link(
            '<i class="fas fa-user fa-tachometer-alt"></i> <span>Pacientes</span>',
            ['controller' => 'Usuarios', 'action' => 'index'],
            ['class' => 'nav-link', 'escape' => false]
        ); ?>
    </li>

    <li class="nav-item <?= str_contains($menu_activo, 'citas') ? 'active' : ''; ?>">
        <!-- Elemento - Citas -->
        <?= $this->Html->link(
            '<i class="fas fa-list-ol"></i> <span>Citas</span>',
            ['controller' => 'Citas', 'action' => 'index'],
            ['class' => 'nav-link', 'escape' => false]
        ); ?>
    </li>

    <li class="nav-item <?= str_contains($menu_activo, 'calendarios') ? 'active' : ''; ?>">
        <!-- Elemento - Calendarios -->
        <?= $this->Html->link(
            '<i class="fas fa-calendar-alt"></i> <span>Calendarios</span>',
            ['controller' => 'Calendarios', 'action' => 'index'],
            ['class' => 'nav-link', 'escape' => false]
        ); ?>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->