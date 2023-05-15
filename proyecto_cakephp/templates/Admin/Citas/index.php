 <!-- DataTales Example -->
 <div class="container-fluid mt-5">

     <div class="row">
         <div class="col">
             <h1 class="h3 mb-2 text-gray-800">Citas del año <?= $anio_calendario; ?></h1>
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
                if ($usuario_id != null && !$citas->count()) { ?>
                 <div class="alert alert-info">
                     No existen citas para el cliente.
                 </div>
                 <?php } else {
                    if (!$citas->count()) { ?>
                     <div class="alert alert-info">
                         No existen citas.
                     </div>
                 <?php
                    } else{
                        if(!empty($usuario_id)){
                            foreach($citas as $cita){
                                //print_r($cita);
                                echo $cita->fecha;
                                echo $cita->hora;
                            }
                        }else{
                            $fechas_citas = array();
                            //Visualizar todo
                            foreach($citas as $cita){
                                $fechas_citas[] = $cita->fecha->format('Y-n-d');
                            }
                            $fechas_citas = array_unique($fechas_citas);
                            //print_r($fechas_citas);
                        }

                    }?>
                 <div class="table-responsive">
                     <?php
                        $weekdays = $this->diassemanaEN_sub;
                        foreach ($calendario_completo as $month => $weeks) {
                            $i = 0;
                            ?>
                            <p class="h4"><?= $this->nombres_mesesES[$month - 1]; ?></p>
                            
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                             <?php foreach ($weeks as $week => $days) {
                                    if ($i == 0) { ?>
                                     <thead>
                                         <th><?php echo implode('</th><th>', $this->diassemanaES_sub); ?></th>
                                     </thead>
                                 <?php $i++;
                                    } ?>
                                 <tr>
                                     <?php foreach ($weekdays as $day) {
                                        $dia = isset($days[$day]) ? $days[$day] : '&nbsp';
                                        $mes = $month;
                                        $fecha_actual = $anio_calendario. '-'. $mes.'-'.$dia;
                                        $existe_fecha = in_array($fecha_actual,$fechas_citas);
                                        if(!$existe_fecha){ ?>
                                            <td>
                                             <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
                                         </td>
                                       <?php }else{?>
                                            <td class="table-date active-date font-weight-bold">
                                             <?php echo isset($days[$day]) ? $days[$day] : '&nbsp'; ?>
                                         </td>
                                        <?php }
                                         
                                      } ?>
                                 </tr>
                             <?php } ?>
                         </table>
                     <?php } ?>
                 </div>
             <?php
                }
                ?>

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