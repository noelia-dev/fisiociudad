<!-- Tabla de citas del día -->
 <div style="text-align: center; position: fixed; top: 20px; width: 100%;">
     <h3>Citas de la fecha
         <?php 
         //setlocale(LC_TIME, 'es_ES.utf-8'); // Establecer la configuración regional en español
            $fecha = $resultado_citas->first()->fecha;
           // $fecha_completa = (new \IntlDateFormatter('es_ES', \IntlDateFormatter::FULL, \IntlDateFormatter::NONE))->format(strtotime($fecha));
            echo DateTime::createFromFormat('d/n/y', $fecha)->format('d/m/Y');;
            ?>
     </h3>
 </div>
 <div class="table-responsive">
     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead>
             <tr>
                 <th>#</th>
                 <th>Hora</th>
                 <th>Nombre paciente</th>
                 <th>Nota paciente</th>
                 <th>Nota profesional</th>
             </tr>
         </thead>
         <tbody>
             <?php
                foreach ($resultado_citas as $cita) { ?>
                 <tr>
                     <td></td>
                     <td class="aling-middle"><?= $cita->hora ?></td>
                     <td class="aling-middle"><?= $cita->usuario->nombre . ' ' . $cita->usuario->apellidos; ?></td>
                     <td class="aling-middle"><?= $cita->usuario->telefono ?></td>
                     <td class="aling-middle"><?= $cita->nota_paciente ?></td>
                     <td class="aling-middle"><?= $cita->nota_profesional ?></td>
                 </tr>
             <?php
                } ?>
         </tbody>
     </table>
 </div>