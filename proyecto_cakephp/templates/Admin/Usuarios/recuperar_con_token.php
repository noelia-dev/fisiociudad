 <!-- DataTales Example -->


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
                                 <h1 class="h4 text-gray-900 mb-4">Proceso de recuperación de contraseña</h1>
                             </div>
                             <div class="card shadow my-5">
                                 <?= $this->Form->create($usuario, ['class' => 'usuario']); ?>
                                 <?= $this->Form->control('token', [
                                        'class' => '', 'label' => [
                                            'id' => 'token'
                                        ],
                                        'type' => 'hidden',
                                        'value' => $token
                                    ]); ?>

                                 <div class="card-header py-3">
                                     <h6 class="m-0 font-weight-bold text-primary">Modificar contraseña</h6>
                                 </div>
                                 <div class="card-body">
                                     <div class="form-group row">
                                         <div class="col-sm-6 mb-3 mb-sm-0">
                                             <?= $this->Form->password('password', ['class' => 'form-control form-control-user', 'placeholder' => 'password', 'label' => '', 'type' => 'string', 'value' => '', 'required' => true,]); ?>
                                         </div>
                                         <div class="col-sm-6">
                                             <?= $this->Form->password('confirm_password', ['class' => 'form-control form-control-user', 'placeholder' => 'Repetir password', 'label' => '', 'type' => 'string', 'value' => '', 'required' => true,]); ?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card-footer">
                                     <?= $this->Form->submit('Guardar', ['class' => 'btn btn-primary btn-user']); ?>
                                     <?= $this->Html->link('Cancelar', ['controller' => 'Pages', 'action' => 'index'], ['class' => 'btn btn-secondary btn-user']) ?>
                                 </div>
                                 <?= $this->Form->end(); ?>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>