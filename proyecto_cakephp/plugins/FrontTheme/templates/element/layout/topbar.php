<nav class="navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container-fluid p-0">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto text-left">
                <!-- Imagen izquierda -->
                <?= $this->Html->link(
                    $this->Html->image('logo_web.jpg', ['alt' => 'Fisiociudad', 'class' => 'img-fluid d-none d-sm-block']),
                    [
                        'action' => 'index'
                    ],
                    ['class' => '', 'escape' => false]
                ); ?>
                <?= $this->Html->link(
                    $this->Html->image('/back_theme/img/logo_fisio.png', ['alt' => 'Fisiociudad', 'class' => 'img-fluid d-block d-sm-none  img-fluid vertical-center']),
                    [
                        'action' => 'index'
                    ],
                    ['class' => '', 'escape' => false]
                ); ?>

            </div>
            <div class="col-auto text-center">
                <!-- Título -->
                <h2 class="text-center">Calendario de disponibilidad</h2>
            </div>
            <div class="col-auto text-right">
                <!-- Imagen derecha -->
                <?= $this->Html->link(
                    'Administrar',
                    [
                        'controller' => 'Admin', 'action' => '/usuarios/login'
                    ],
                    ['class' => 'btn btn-primary d-none d-sm-block']
                ); ?>

                <?= $this->Html->link(
                    '<i class="fas fa-user-cog"></i>',
                    [
                        'controller' => 'Admin', 'action' => '/usuarios/login'
                    ],
                    ['class' => 'btn d-block d-sm-none', 'escape' => false]
                ); ?>
            </div>
        </div>
    </div>

</nav>