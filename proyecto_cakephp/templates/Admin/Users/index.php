 <!-- DataTales Example -->
 <div class="container-fluid mt-5">
     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Usuarios</h1>
           <!--   <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
         --> </div>
         <div class="col text-right">
         <?= $this->Html->link('<i class="fas fa-plus"></i>Añadir usuario', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Lista de usuarios y clientes</h6>
         </div>
         <div class="card-body">
            <?php //En caso de que no existan registros mostraremos el mensaje correspondiente
            if(!$users->count()){?>
                <div class="alert alert-info">
                    No existen usuarios para mostrar.
                </div>
            <?php 
            }else{
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
                            foreach ($users as $usuario) { ?>
                             <tr>
                                 <td class="aling-middle"><?= $usuario->nombre ?></td>
                                 <td class="aling-middle"><?= $usuario->apellidos ?></td>
                                 <td class="aling-middle"><?= $usuario->alta ?></td>
                                 <td class="aling-right">
                                     <?= $this->Html->link('<i class="fas fa-edit"></i>', ['action' => 'edit', $usuario->id_user], ['class' => 'btn btn-warning', 'escape' => false]) ?>
                                     <?= $this->Html->link('<i class="fas fa-trash"></i>', ['action' => 'delete', $usuario->id_user], [
                                            'class' => 'btn btn-danger', 'escape' => false,
                                            'confirm' => '¿Está seguro que desea eliminar este usuario?'
                                        ]) ?>
                                 </td>
                             </tr>
                         <?php };
                            ?>
                     </tbody>
                 </table>
             </div>
              <?php
         }?>
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