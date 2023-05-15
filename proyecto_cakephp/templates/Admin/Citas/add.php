 <!-- DataTales Example -->
 <div class="container-fluid mt-5">
     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
             <!--   <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
         -->
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <?= $this->Form->create($cita, ['class' => 'citas']); ?>
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Añadir cita</h6>
         </div>
         <div class="card-body">
             <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                     <?= $this->Form->control('Usuario', ['class' => 'form-control form-control-user', 'placeholder' => 'Nombre', 'label' => '', 'type' => 'string']); ?>

                     <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                         <option value="10">10</option>
                         <option value="25">25</option>
                         <option value="50">50</option>
                         <option value="100">100</option>
                     </select>
                     
                    <?= $this->Form->time('hora', [
                        'value' => date('d/m/y H:i:s')
                    ]);?>
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
                            'class' => '', 'id' => 'es_admin'
                        ]); ?>
                     <?= $this->Form->label(
                            'es_admin',
                            '¿Es un usuario administrador?',
                            ['for' => 'es_admin']
                        ); ?>
                 </div>
             </div>
         </div>
         <div class="card-footer">
             <?= $this->Form->submit('Crear usuario', ['class' => 'btn btn-primary btn-user btn-block']); ?>
         </div>
         <?= $this->Form->end(); ?>
     </div>
 </div>
 <!-- End of Content Wrapper -->