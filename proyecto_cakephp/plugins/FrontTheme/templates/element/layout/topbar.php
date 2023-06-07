<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">


    <!-- Barra superior -->
    <div class="container-fluid">
        <div class="row justify-content-center" style="width: 100%;">
            <div class="col text-center d-flex align-items-center">
                <?= $this->Html->link(
                    $this->Html->image('logo_web.jpg', ['alt' => 'Fisiociudad', 'class' => 'justify-content-center']),
                    [
                        'action' => 'index'
                    ],
                    ['class' => 'd-none d-sm-inline-block btn btn-sm shadow-sm', 'escape' => false]
                ); ?>
            </div>
            <div class="col text-center d-flex align-items-center">
                <h2 class="heading-section">Calendario de disponibilidad</h2>
            </div>
            <div class="col text-center d-flex align-items-center">
                <?= $this->Html->link(
                    'Administrar',
                    [
                        'controller' => 'Admin', 'action' => '/usuarios/login'
                    ],
                    ['class' => 'd-none d-sm-inline-block btn btn-sm btn-primary shadow-sm']
                ); ?>
            </div>
        </div>
    </div>

</nav>