<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center mb-5">
                <h2 class="heading-section">Calendario de disponibilidad</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="content w-100">
                    <div class="calendar-container">
                        <div class="calendar">
                            <div class="year-header">
                                <span class="left-button fa fa-chevron-left" id="prev"> </span>
                                <span class="year" id="label"></span>
                                <span class="right-button fa fa-chevron-right" id="next"> </span>
                            </div>
                            <table class="months-table w-100">
                                <tbody>
                                    <tr class="months-row">
                                        <?php
                                        $i = 1;
                                        foreach ($meses as $mes) {
                                            if ($mes_mostrar <= $i) { ?>
                                                <td class="month" mes="<?= substr($this->get_nombre_mes($i), 0, 3); ?>"><?= $mes ?></td>
                                            <?php } else { //ocultamos los meses anteriores 
                                            ?>
                                                <td class="month d-none"></td>
                                            <?php } ?>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="days-table w-100">
                                <?php foreach ($this->diassemanaES_sub as $dia) { ?>
                                    <td class="day"><?= $dia ?></td>
                                <?php  } ?>
                            </table>
                            <div class="frame">
                                <table class="dates-table w-100" id="calendario_cliente">
                                    <tbody class="tbody">
                                    </tbody>
                                </table>
                            </div>
                            <button class="button" id="add-button">Solicitar cita</button>
                        </div>
                    </div>


                    <div class="events-container">
                        
                    </div>
                    <div class="dialog" id="dialog">
                        <h2 class="dialog-header">Solicitar cita</h2>
                        <form class="form" id="form">
                            <?= $this->Form->create($this->cita, ['class' => 'cita']); ?>

                            <div class="form-container" align="center">
                                <?= $this->Form->control('Nombre', [
                                    'class' => 'input_solicitud',
                                    'placeholder' => '', 'label' => [
                                        'id' => 'nombre',
                                        'class' => 'form-label'
                                    ],
                                    'type' => 'text',
                                    'maxlength' => '36'
                                ]); ?>

                                <?= $this->Form->control('Apellidos', [
                                    'class' => 'input_solicitud', 'placeholder' => '', 'label' => [
                                        'id' => 'apellidos',
                                        'class' => 'form-label'
                                    ],
                                    'type' => 'text',
                                    'maxlength' => '36'
                                ]); ?>

                                <?= $this->Form->control(
                                    'correo electrónico',
                                    [
                                        'class' => 'input_solicitud', 'placeholder' => '', 'label' => [
                                            'id' => 'correo',
                                            'class' => 'form-label'
                                        ], 'type' => 'email', 'maxlength' => '36'
                                    ]
                                ); ?>
                                <?= $this->Form->control('Número de teléfono', ['class' => 'input_solicitud', 'placeholder' => '', 'label' => [
                                    'id' => 'telefono',
                                    'class' => 'form-label'
                                ], 'type' => 'string']); ?>

                                <?= $this->Form->button('Cancelar', ['class' => 'button','id'=>'cancel-button','type' => 'submit']); ?>
                                <?= $this->Form->button('Solicitar', ['class' => 'button','id'=>'ok-button','type' => 'submit']); ?>
                            </div>
                            <?= $this->Form->end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>