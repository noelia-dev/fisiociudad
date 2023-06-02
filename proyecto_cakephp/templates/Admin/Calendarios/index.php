 <!-- DataTales Example -->
 <div class="container-fluid mt-5">

     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Calendarios del año <?= $anio_calendario; ?></h1>
             <?= $this->Flash->render() ?>
             <p class="mb-4">Eliminación multiple disponible con multiple selección</a>.</p>

         </div>
         <!-- Creamos el formulario para poder hacer una multiselección y eliminar una o varías fechas a la vez-->
         <?= $this->Form->create(null, ['url' => ['action' => 'delete'], 'type' => 'post', 'id' => 'fechasSeleccion']); ?>
         <div class="col text-right">
             <?= $this->Html->link('<i class="fas fa-plus"></i>Añadir fecha', ['action' => 'add'], ['class' => 'btn btn-success', 'escape' => false]) ?>
             <?= $this->Form->button(
                    '<i class="fas fa-trash"></i>Eliminar fecha/s',
                    [
                        'type' => 'submit', 'escapeTitle' => false, 'class' => 'btn btn-danger',
                        // 'onclick' => "return confirm('¿Está seguro que desea eliminar las siguientes fechas?');"
                    ]

                ); ?>
         </div>
     </div>
     <!-- Page Heading -->
     <div class="card shadow my-5">
         <div class="card-body">
             <?php //En caso de que no existan registros mostraremos el mensaje correspondiente
                if (!count($calendarios)) { ?>
                 <div class="alert alert-info">
                     No existen datos en el calendario.
                 </div>
             <?php } ?>
             <div class="container-fluid">
                 <?php
                    $weekdays = $this->diassemanaEN_sub;
                    foreach ($calendario_completo as $month => $weeks) {
                        $i = 0;
                        if ($month % 3 == 0) { //Meses divisibles por 3
                    ?>
                         <div class="col-sm-4">
                         <?php } elseif (($month + 1) % 3 == 0) { //NO divisibles
                            ?>
                             <div class="col-sm-4">
                             <?php } else { ?>
                                 <div class="row">
                                     <div class="col-sm-4">
                                     <?php } ?>
                                     <p class="h2"><?= $this->nombres_mesesES[$month - 1]; ?></p>
                                     <table class="table table-bordered" id="CalendarioCompleto" width="100%" cellspacing="0">
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
                                                        $dia = isset($days[$day]) ? $days[$day] : '&nbsp';
                                                        $mes = $month;
                                                        $fecha_actual = date('Y-m-d', strtotime($anio_calendario . '-' . $mes . '-' . $dia));
                                                        $existe_fecha = in_array($fecha_actual, array_column($calendarios, 'fecha'));
                                                        if (!$existe_fecha) { ?>
                                                         <td class="table-date">
                                                             <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
                                                         </td>
                                                     <?php } else { ?>
                                                         <td id='btnSeleccionable' class="table-date active-date font-weight-bold seleccionable" data-id="<?= date('Y-m-d', strtotime($fecha_actual)) ?>">
                                                             <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
                                                             <?= $this->Form->checkbox('selected_ids[]', ['value' => date('Y-m-d', strtotime($fecha_actual)), 'hiddenField' => false, 'class' => 'd-none']) ?>
                                                         </td>
                                                 <?php }
                                                    } ?>
                                             </tr>
                                         <?php } ?>
                                     </table>

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
                         <!--
                         <nav class="d-inline-block">
                             <ul class="pagination">
                                 < ?= $this->Paginator->prev('<'); ?>
                                 < ?= $this->Paginator->numbers() ?>
                                 < ?= $this->Paginator->next('>'); ?>
                             </ul>
                         </nav>
                                 -->
             </div>

         </div>

     </div>

     <?php echo $this->Form->end(); ?>
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