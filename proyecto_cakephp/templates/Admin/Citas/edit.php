 <!-- DataTales Example -->
 <div class="container-fluid mt-5">
     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Editar usuario</h1>
             <!--   <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
         -->
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <?= $this->Form->create($usuario, ['class' => 'user']); ?>
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Datos del usuario</h6>
         </div>
         <div class="card-body">
             <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                     <?= $this->Form->control('nombre', ['class' => 'form-control form-control-user', 'placeholder' => 'Nombre', 'label' => '', 'type' => 'string']); ?>
                 </div>
                 <div class="col-sm-6">
                     <?= $this->Form->control('apellidos', ['class' => 'form-control form-control-user', 'placeholder' => 'Apellido/s', 'label' => '', 'type' => 'string']); ?>
                 </div>
             </div>
             <div class="form-group">
                 <?= $this->Form->control('correo', ['class' => 'form-control form-control-user', 'placeholder' => 'mail@gmail.com', 'label' => '', 'type' => 'email']); ?>
             </div>
             <div class="form-group">
                 <?= $this->Form->control('telefono', ['class' => 'form-control form-control-user', 'placeholder' => '677777777', 'label' => '', 'type' => 'string']); ?>
             </div>
             <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <?= $this->Form->password('password', ['class' => 'form-control form-control-user', 'placeholder' => 'password', 'label' => '', 'type' => 'string']); ?>
                </div>
                <div class="col-sm-6">
                    <?= $this->Form->password('confirm_password', ['class' => 'form-control form-control-user', 'placeholder' => 'password', 'label' => '', 'type' => 'string']); ?>
                </div>
             </div>
             <div class="form-group">
                 <div class="custom-control custom-checkbox small">                 
                     <?= $this->Form->checkbox('es_admin', [
                            'class' => '', 'id'=>'es_admin'
                        ]); ?> 
                        <?= $this->Form->label('es_admin', '¿Es un usuario administrador?'
                            ,['for'=>'es_admin']);?>                     
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