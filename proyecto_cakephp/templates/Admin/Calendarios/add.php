 <!-- DataTales Example -->
 <div class="container-fluid mt-5">
     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Añadir una nueva fecha</h1>
             <p class="mb-4">Con este proceso se pueden añadir días laborales</a>.</p>
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <?= $this->Form->create($calendario, ['class' => 'calendarios']); ?>
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Añadir fecha</h6>
         </div>
         <div class="card-body">
             <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                     <?= $this->Form->control('fecha', [
                            'type' => 'date',
                            'label' => 'Fecha:',
                            'required' => true,
                            'class' => 'form-control'
                        ]); ?>
                 </div>

                 <div class="col-sm-6">
                 <?= $this->Form->control('descripcion', ['class' => 'form-control form-control-user', 'placeholder' => 'Nota', 'label' => 'Nota descriptiva', 'type' => 'string']); ?>
                 </div>
             </div>
         </div>
         <div class="card-footer">
             <?= $this->Form->submit('Añadir fecha al calendario laboral', ['class' => 'btn btn-primary btn-user btn-block']); ?>
         </div>
         <?= $this->Form->end(); ?>
     </div>
 </div>
 <!-- End of Content Wrapper -->