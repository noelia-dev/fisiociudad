 <!-- DataTales Example -->
 <div class="container-fluid mt-5">
     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Editar cita del usuario <strong><?= $usuario_nombre ?></strong></h1>
             <!--   <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
         -->
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <?= $this->Form->create($cita, ['class' => 'Citas', $cita->id]); ?>
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Datos de la cita</h6>
         </div>
         <div class="card-body">
             <div class="form-group row">
                 <div class="col-sm-6 mb-3 mb-sm-0">
                     <?= $this->Form->control('fecha', [
                            'type' => 'date',
                            'label' => 'Fecha:',
                            'required' => true,
                            'class' => 'form-control',
                            'error' => false //evitamos que el error se establezca debajo del campo, se mostrará en el Flash
                        ]); ?>
                 </div>
                 <div class="col-sm-6">
                     <?= $this->Form->control('hora', [
                            'type' => 'time',
                            'label' => 'Hora:',
                            'required' => true,
                            'class' => 'form-control',
                            'error' => false //evitamos que el error se establezca debajo del campo, se mostrará en el Flash
                        ]);
                        ?>
                 </div>
             </div>
             <div class="form-group row">
                 <div class="col-sm-6">
                     <?= $this->Form->textarea('nota_paciente', [
                            'class' => 'form-control',
                            'rows' => 5,
                            'placeholder' => 'Nota paciente',
                            'required' => false,
                            'label' => 'Nota del paciente',
                            'style' => 'resize: none',
                            'error' => false //evitamos que el error se establezca debajo del campo, se mostrará en el Flash
                        ]); ?>
                 </div>
             </div>
             <div class="form-group">
                 <div class="col-sm-6">
                     <?= $this->Form->textarea('nota_profesional', [
                            'class' => 'form-control',
                            'rows' => 5,
                            'placeholder' => 'Nota profesional',
                            'required' => false,
                            'label' => 'Nota del profesional',
                            'style' => 'resize: none',
                            'error' => false //evitamos que el error se establezca debajo del campo, se mostrará en el Flash
                        ]); ?>
                 </div>
             </div>
             <div class="card-footer">
                 <?= $this->Form->submit('Guardar', ['class' => 'btn btn-primary btn-user btn-block']); ?>
             </div>
             <?= $this->Form->end(); ?>
         </div>
     </div>
 </div>
 <!-- End of Content Wrapper -->