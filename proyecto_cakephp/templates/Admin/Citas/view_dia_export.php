<!-- Tabla de citas del día -->
 <div style="text-align: center; position: fixed; top: 20px; width: 100%;">
     <h3>Citas de la fecha
         <?php 
            $fecha = $resultado_citas->first()->fecha;
            echo DateTime::createFromFormat('d/n/y', $fecha)->format('d/m/Y');
            ?>
     </h3>
 </div>
 <div class="table-responsive">
     <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="border-collapse: collapse;">
         <thead>
             <tr style="border: 1px solid darkblue;">
                 <th style="border: 1px solid darkblue;width: 3%;">#</th>
                 <th style="border: 1px solid darkblue;width: 7%;">Hora</th>
                 <th style="border: 1px solid darkblue;width: 15%;">Nombre paciente</th>
                 <th style="border: 1px solid darkblue;width: 11%;">Teléfono</th>
                 <th style="border: 1px solid darkblue;width: 22%;">Nota paciente</th>
                 <th style="border: 1px solid darkblue;width: 22%;">Nota profesional</th>
             </tr>
         </thead>
         <tbody>
             <?php
             $i= 1;
                foreach ($resultado_citas as $cita) { ?>
                 <tr>
                     <td style="border: 1px solid darkblue;text-align: center;"><?= $i?></td>
                     <td style="border: 1px solid darkblue;text-align: center;" class="aling-middle"><?= $cita->hora ?></td>
                     <td style="border: 1px solid darkblue;text-align: center;" class="aling-middle"><?= $cita->usuario->nombre . ' ' . $cita->usuario->apellidos; ?></td>
                     <td style="border: 1px solid darkblue;text-align: center;" class="aling-middle"><?= $cita->usuario->telefono ?></td>
                     <td style="border: 1px solid darkblue;text-align: center;" class="aling-middle"><?= $cita->nota_paciente ?></td>
                     <td style="border: 1px solid darkblue;text-align: center;" class="aling-middle"><?= $cita->nota_profesional ?></td>
                 </tr>
             <?php $i++;
                } ?>
         </tbody>
     </table>
 </div>