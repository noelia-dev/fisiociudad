 <!-- DataTales Example -->
 <div class="container-fluid mt-5">

     <div class="row">
         <div class="col menu_titulo">
             <h1 class="h3 mb-2 text-gray-800"><i class="fas fa-list-ol"></i> Citas del año <?= $anio_calendario; ?></h1>
             <?= $this->Flash->render() ?>
         </div>
         <div class="col text-right d-flex justify-content-center">
             <?= $this->Html->link('<i class="fas fa-plus"></i>Añadir cita', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
         </div>
     </div>
     <!-- Page Heading -->

     <div class="card shadow my-5">
         <div class="card-body">
             <?php //En caso de que no existan registros mostraremos el mensaje correspondiente
                if (!count($citas)) { ?>
                 <div class="alert alert-info">
                     No existen citas para este año.
                 </div>
             <?php } ?>
             <div class="container-fluid">
                 <?php
                    //print_r($citas);
                    $weekdays = $this->diassemanaEN_sub;
                    foreach ($calendario_completo as $month => $weeks) {
                        $i = 0;
                        if ($month % 3 == 0) { //Meses divisibles por 3
                    ?>
                         <div class="col">
                         <?php } elseif (($month + 1) % 3 == 0) { //NO divisibles
                            ?>
                             <div class="col">
                             <?php } else { ?>
                                 <div class="row">
                                     <div class="col">
                                     <?php } ?>
                                     <div class="table-responsive">
                                     <p class="h2"><?= $this->nombres_mesesES[$month - 1]; ?></p>
                                     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                         <?php foreach ($weeks as $week => $days) {
                                                if ($i == 0) { ?>
                                                 <thead>
                                                     <th><?php echo implode('</th><th>', $this->diassemanaES_sub); ?></th>
                                                 </thead>
                                             <?php
                                                }
                                                $i++; ?>
                                             <tr class="table-row">
                                                 <?php foreach ($weekdays as $day) {
                                                        $mes = $month;
                                                        $dia = isset($days[$day]) ? $days[$day] : '&nbsp';
                                                        $existe_fecha = false;

                                                        if (isset($days[$day])) {
                                                            $fecha_actual = date('Y-m-d',strtotime($anio_calendario . '/'.$mes.'/' . $dia));
                                                            //$fecha_actual = $anio_calendario . '-' . $mes . '-' . $dia;
                                                            $existe_fecha = in_array($fecha_actual, $fechas_citas);
                                                        }
                                                        if (!$existe_fecha) { ?>
                                                         <td class="table-date">
                                                             <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
                                                         </td>
                                                     <?php } else { //Fecha activa y consultable
                                                        ?>
                                                         <td class="table-date active-date font-weight-bold">
                                                             <?php $dia_mostrar = isset($days[$day]) ? $days[$day] : '&nbsp';
                                                                echo $this->Html->link($dia_mostrar, [
                                                                    'controller' => 'Citas', 'action' => 'viewDia', $dia_mostrar,$mes,$anio_calendario
                                                                ]) ?>

                                                         </td>
                                                 <?php }
                                                    } ?>
                                             </tr>
                                         <?php } ?>
                                     </table>
                                     </div>
                                     <?php
                                        if ($month % 3 == 0) { //Meses divisibles por 3
                                        ?>
                                     </div>
                                 </div>
                             <?php } else { ?>
                             </div>
                         <?php } ?>
                     <?php } ?>
                         </div>
                         <!-- nav class="d-inline-block">
                             <ul class="pagination">
                                 < ?= $this->Paginator->prev('<'); ?>
                                 < ?= $this->Paginator->numbers() ?>
                                 < ?= $this->Paginator->next('>'); ?>
                             </ul>
                         </nav-->

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