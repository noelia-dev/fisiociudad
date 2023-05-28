<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
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
                                            if ((int)date('m') <= $i) { ?>
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
                            <div class="form-container" align="center">
                                <label class="form-label" id="valueFromMyButton" for="nobre">Nombre</label>
                                <input class="input" type="text" id="nobre" maxlength="36">
                                <label class="form-label" id="valueFromMyButton" for="apellidos">Apellidos</label>
                                <input class="input" type="text" id="apellidos" maxlength="36">
                                <label class="form-label" id="valueFromMyButton" for="name">correo electrónico</label>
                                <input class="input" type="text" id="name" maxlength="36">
                                <label class="form-label" id="valueFromMyButton" for="count">Número de teléfono</label>
                                <input class="input" type="number" id="count" min="0" max="1000000" maxlength="7">
                                <input type="button" value="Cancelar" class="button" id="cancel-button">
                                <input type="button" value="Solicitar" class="button button-white" id="ok-button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>