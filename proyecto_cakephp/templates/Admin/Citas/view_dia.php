 <!-- DataTales Example -->
 <div class="container-fluid mt-5">

     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Citas del día <?= $fecha_mostrar ?></h1>
             <?= $this->Flash->render() ?>
             <!--   <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
         -->
         </div>
         <div class="col text-right">
             <?= $this->Html->link('<i class="fas fa-plus"></i>Añadir cita', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
             <?= $this->Html->link('<i class="fas fa-file-pdf"></i>Exportar', ['action' => 'exportar_pdf', $fecha_mostrar], ['class' => 'btn btn-info', 'escape' => false]) ?>

         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <div class="card-body">
             <?php //En caso de que no existan registros mostraremos el mensaje correspondiente
                if (!$citas_por_usuario->count()) { ?>
                 <div class="alert alert-info">
                     No existen citas para mostrar.
                 </div>
             <?php
                } else {
                ?>
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Paciente</th>
                                 <th>Hora</th>
                                 <th>Nota profesional</th>
                                 <th>Fecha solicitud</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                foreach ($citas_por_usuario as $cita) { ?>
                                 <tr>
                                     <td class="aling-middle"><?= $cita->usuario->nombre . ' ' . $cita->usuario->apellidos ?></td>
                                     <td class="aling-middle"><?= $cita->hora ?></td>
                                     <td class="aling-middle"><?= $cita->nota_paciente ?></td>
                                     <td class="aling-middle"><?= $cita->nota_profesional ?></td>
                                     <td class="aling-right">
                                         <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $cita->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                         <?= $this->Html->link('<i class="fas fa-trash"></i>', ['action' => 'delete', $cita->id], [
                                                'class' => 'btn btn-danger', 'escape' => false,
                                                'confirm' => '¿Está seguro que desea eliminar este cita?'
                                            ]) ?>
                                     </td>
                                 </tr>
                             <?php };
                                ?>
                         </tbody>
                     </table>
                 </div>
                 <nav class="d-inline-block">
                     <ul class="pagination">
                         <?= $this->Paginator->prev('<'); ?>
                         <?= $this->Paginator->numbers() ?>
                         <?= $this->Paginator->next('>'); ?>
                     </ul>
                 </nav>
             <?php
                } ?>
         </div>

     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 <!-- Footer -->
 <!-- <footer class="sticky-footer bg-white">
     <div class="container my-auto">
         <div class="copyright text-center my-auto">
             <span>Copyright &copy; Your Website 2019</span>
         </div>
     </div>
 </footer>
  End of Footer -->

 </div>
 <!-- End of Content Wrapper -->