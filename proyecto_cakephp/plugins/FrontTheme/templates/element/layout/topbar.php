<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Barra superior -->
    <?= $this->Html->link(
        'Administrar',
        [
            'controller' => 'Admin', 'action' => 'index'
        ],
        ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']
    ); ?>
</nav>