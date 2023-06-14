 <!-- DataTales Example -->
 <div class="container-fluid mt-5">
     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Editar contraseña</h1>
              <p class="mb-4">Al modificar la contraseña será redirigido a la página de login.</p>
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <?= $this->Form->create($usuario, ['class' => 'usuario']); ?>
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Modificar contraseña</h6>
         </div>
         <div class="card-body">
             <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                     <?= $this->Form->password('password', ['class' => 'form-control form-control-user', 'placeholder' => 'password', 'label' => '', 'type' => 'string', 'value' => '', 'required' => true,]); ?>
                 </div>
                 <div class="col-sm-6">
                     <?= $this->Form->password('confirm_password', ['class' => 'form-control form-control-user', 'placeholder' => 'password', 'label' => '', 'type' => 'string', 'value' => '', 'required' => true,]); ?>
                 </div>
             </div>
         </div>
         <div class="card-footer">
             <?= $this->Form->submit('Guardar', ['class' => 'btn btn-primary btn-user btn-block']); ?>
         </div>
         <?= $this->Form->end(); ?>
     </div>
 </div>
 <!-- End of Content Wrapper -->