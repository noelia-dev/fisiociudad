$(document).ready(function () {
    //@TODO    $('.select2').select2();


});

function obtener_Nodisponibilidad(mes_seleccionado, anio) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/AjaxRespuestas/diasSinCita",
            type: "POST",
            data: {
                mes: mes_seleccionado,
                anio: anio
            },
            dataType: 'json',
            success: function (respuesta_Datos) {
                //  event_data = respuesta_Datos;
                //console.log(respuesta_Datos['success']);
                //noLaboral = respuesta_Datos['success'];
                resolve(respuesta_Datos['success']);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Maneja los errores de la solicitud
                console.log(textStatus, errorThrown);
                reject(textStatus, errorThrown);
            }
        });
    })
}

async function miFuncionPrincipal(mes_seleccionado, anio) {
    try {
        const resultado = await obtener_Nodisponibilidad(mes_seleccionado, anio);
        //console.log('Resultado de la llamada AJAX:', resultado);
        return resultado;
        // Aquí puedes continuar con la ejecución del código después de obtener el resultado
    } catch (error) {
        console.log('Ocurrió un error:', error);
        // Manejar el error en caso de que ocurra
    }
}

function listar_disponibilidad(month, day, year) {

    var events = [];
    // AJAX request
    $.ajax({
        url: "/AjaxRespuestas/obtenerHorarios",
        type: "POST",
        data: {
            dia: day,
            mes: month,
            anio: year
        },
        dataType: 'json',
        success: function (respuesta_Datos) {
            //  event_data = respuesta_Datos;
            mostrar_datos_evento(respuesta_Datos['success'], day, month, year);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Maneja los errores de la solicitud
            console.log(textStatus, errorThrown);
        }
    });

}


// Display all events of the selected date in card views
function mostrar_datos_evento(horas_disponibles, day, month, year) {
    // console.log(horas_disponibles);
    // Clear the dates container
    $(".events-container").empty();
    $(".events-container").hide();
    $(".events-container").show(300);
    // Mostrar el reloj de carga
    //   $(".loading-overlay").show();
    //     console.log(event_data["events"]);
    // If there are no events for this date, notify the user
    if (horas_disponibles.length === 0) {
        var event_card = $("<div class='event-card'></div>");
        var event_name = $("<div class='event-name'>No exite disponibilidad: " + month + " " + day + ".</div>");
        $(event_card).css({ "border-left": "10px solid #FF1744" });
        $(event_card).append(event_name);
        $(".events-container").append(event_card);
    }
    else {
        var lista_titulo = $("<div class='horario-titulo h4 text-center'>Horarios disponibles <p>" + day + "/" + month + "/" + year + "</p></div>");
        //$(lista_titulo).css({ "border-left": "10px solid #FF1744" });
        $(".events-container").append(lista_titulo);
        // Go through and add each event as a card to the events container
        for (var i = 0; i < horas_disponibles.length; i++) {
            let formatea_hora= horas_disponibles[i].split(":").slice(0, 2).join(":");
            var event_card = $("<div class='event-card'></div>");
            var event_name = $("<div class='event-name'>" + formatea_hora + " - </div>");
            var event_count = $("<div class='event-count'>Disponible</div>");
            var evento_add = $("<a href='#' id='add-boton'></a>");//Añadir solicitud
            //A cada horario disponible creamos su evento con la fecha y la hora disponible.
            evento_add.click({ date: (year + '-' + month + '-' + day), hora: horas_disponibles[i] }, nuevo_evento);
            $(event_card).append(event_name).append(event_count);
            $(evento_add).append(event_card);
            $(".events-container").append(evento_add);
        }
    }

}

function nuevo_evento(event) {
    // if a date isn't selected then do nothing
    if ($(".active-date").length === 0)
        return;
    // remove red error input on click
    $("input").click(function () {
        $(this).removeClass("error-input");
    })
    // empty inputs and hide events
    $("#dialog input[type=text]").val('');
    $("#dialog input[type=number]").val('');
    $(".events-container").hide(250);
    $("#dialog #hora").val(event.data.hora); 
    $("#dialog #fecha").val(event.data.date); 
    $("#dialog").show(250);
    // Event handler for cancel button
    $("#cancel-button").click(function () {
        $("#name").removeClass("error-input");
        $("#count").removeClass("error-input");
        $("#dialog").hide(250);
        $(".events-container").show(250);
    });
    // Event handler for ok button
    $("#ok-button").unbind().click({ date: event.data.date, hora: event.data.hora }, function () {
        var date = event.data.date;
        var hora = event.data.hora;
        //var name = $("#name").val().trim();
        //var count = parseInt($("#count").val().trim());
        var day = parseInt($(".active-date").html());
        // Basic form validation
        if (name.length === 0) {
            $("#name").addClass("error-input");
        }
        else if (isNaN(count)) {
            $("#count").addClass("error-input");
        }
        else {
            $("#dialog").hide(250);
            //console.log("new event");
            new_event_json(name, count, date, day);
            date.setDate(day);
            init_calendar(date);
        }
    });
}


/*$(document).ready(function() {
    //Función de carga del spinner
  //  $(".events-container").hide();
    // Ocultar el reloj de carga y mostrar el contenido después de 5 segundos
    setTimeout(function() {
      $(".loading-overlay").hide();
    //  $(".events-container").show(100);
    }, 4000);
  });*/