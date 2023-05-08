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
                                        <td class="month">Ene</td>
                                        <td class="month">Feb</td>
                                        <td class="month">Mar</td>
                                        <td class="month">Abr</td>
                                        <td class="month">May</td>
                                        <td class="month">Jun</td>
                                        <td class="month">Jul</td>
                                        <td class="month">Ago</td>
                                        <td class="month">Sep</td>
                                        <td class="month">Oct</td>
                                        <td class="month">Nov</td>
                                        <td class="month">Dec</td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="days-table w-100">
                                <td class="day">Dom</td>
                                <td class="day">Lun</td>
                                <td class="day">Mar</td>
                                <td class="day">Mie</td>
                                <td class="day">Jue</td>
                                <td class="day">Vie</td>
                                <td class="day">Sab</td>
                            </table>
                            <div class="frame">
                                <table class="dates-table w-100">
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
                        <h2 class="dialog-header"> Add New Event </h2>
                        <form class="form" id="form">
                            <div class="form-container" align="center">
                                <label class="form-label" id="valueFromMyButton" for="name">Event name</label>
                                <input class="input" type="text" id="name" maxlength="36">
                                <label class="form-label" id="valueFromMyButton" for="count">Number of people to invite</label>
                                <input class="input" type="number" id="count" min="0" max="1000000" maxlength="7">
                                <input type="button" value="Cancel" class="button" id="cancel-button">
                                <input type="button" value="OK" class="button button-white" id="ok-button">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>