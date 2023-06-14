 <!-- DataTales Example -->
 <div class="container-fluid mt-5">

     <div class="row">
         <div class="col menu_titulo">
             <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-user fa-tachometer-alt"></i> Pacientes</h1>
             <?= $this->Flash->render() ?>
         </div>
         <div class="col text-right d-flex justify-content-center">
             <?= $this->Html->link('<i class="fas fa-plus"></i>Añadir paciente', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <div class="card-body">
             <?php //En caso de que no existan registros mostraremos el mensaje correspondiente
                if (!$usuarios->count()) { ?>
                 <div class="alert alert-info">
                     No existen usuarios para mostrar.
                 </div>
             <?php
                } else {
                ?>
                 <div class="table-responsive">
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <thead>
                             <tr>
                                 <th>Nombre</th>
                                 <th>Apellidos</th>
                                 <th>Fecha de alta</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                foreach ($usuarios as $usuario) { ?>
                                 <tr>
                                     <td class="aling-middle"><?= $usuario->nombre ?></td>
                                     <td class="aling-middle"><?= $usuario->apellidos ?></td>
                                     <td class="aling-middle"><?= $usuario->alta ?></td>
                                     <td class="aling-right">
                                         <?= $this->Html->link('<i class="fas fa-list"></i>', ['controller' => 'Citas', 'action' => 'view', $usuario->id], ['class' => 'btn btn-info', 'escape' => false]) ?>
                                         <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $usuario->id], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                         <?= $this->Html->link('<i class="fas fa-trash"></i>', ['action' => 'delete', $usuario->id], [
                                                'class' => 'btn btn-danger delete-link', 'escape' => false,
                                                'data-bs-toggle' => 'modal',
                                                'data-bs-target' => '#deleteModal',
                                                'data-id' => $usuario->id,
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
 <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este post?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger delete-confirm">Eliminar</button>
            </div>
        </div>
    </div>
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