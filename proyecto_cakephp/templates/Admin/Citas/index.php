 <!-- DataTales Example -->
 <div class="container-fluid mt-5">

     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Citas</h1>
             <?= $this->Flash->render() ?>
             <!--   <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
         -->
         </div>
         <div class="col text-right">
             <?= $this->Html->link('<i class="fas fa-plus"></i>Añadir cita', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <div class="card-body">
             <?php //En caso de que no existan registros mostraremos el mensaje correspondiente
                if (!$citas->count()) { ?>
                 <div class="alert alert-info">
                     No existen citas.
                 </div>
             <?php
                }
                ?>
             <div class="table-responsive">

                 <?php

                    $weekdays = $this->diassemanaEN_sub; ?>
                 <?php foreach ($calendario_completo as $month => $weeks) {
                        $i = 0;
                        echo $this->nombres_mesesES[$month - 1]; ?>
                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                         <?php foreach ($weeks as $week => $days) {
                                if ($i == 0) { ?>
                                 <thead>
                                     <th><?php echo implode('</th><th>', $this->diassemanaES_sub); ?></th>
                                 </thead>
                             <?php $i++;
                                } ?>
                             <tr>
                                 <?php foreach ($weekdays as $day) { ?>
                                     <td>
                                         <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
                                     </td>
                                 <?php } ?>
                             </tr>
                         <?php } ?>
                     </table>
                 <?php } ?>
             </div>
             <nav class="d-inline-block">
                 <ul class="pagination">
                     <?= $this->Paginator->prev('<'); ?>
                     <?= $this->Paginator->numbers() ?>
                     <?= $this->Paginator->next('>'); ?>
                 </ul>
             </nav>

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