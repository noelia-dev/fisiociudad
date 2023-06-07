<!--================Cuadro de login =================-->
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Bienvenido a la recuperación de tu contraseña como administrador</h1>
                            </div>
                            <?= $this->Form->create(null, ['class' => 'usuario']) ?>
                            <div class="form-group">
                                <?= $this->Form->control('correo', [
                                    'type' => 'email', 'label' => '', 'class' => 'form-control form-control-user'
                                ]) ?>
                                <!--input name="correo" type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..."-->
                            </div>
                            
                            <div class="form-group">
                                <div style="display: flex;" class="justify-content-center">
                                    <?= $this->Form->submit('Enviar', ['class' => 'btn btn-primary btn-user btn-block']); ?>
                                </div>
                            </div>
                            <?= $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>