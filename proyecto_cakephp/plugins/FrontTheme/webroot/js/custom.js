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
            mostrar_datos_evento(respuesta_Datos['success']);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Maneja los errores de la solicitud
            console.log(textStatus, errorThrown);
        }
    });

}


// Display all events of the selected date in card views
function mostrar_datos_evento(horas_disponibles) {
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
        // Go through and add each event as a card to the events container
        for (var i = 0; i < horas_disponibles.length; i++) {
            var event_card = $("<div class='event-card'></div>");
            var event_name = $("<div class='event-name'>" + horas_disponibles[i] + ":</div>");
            var event_count = $("<div class='event-count'>Disponible</div>");
            /* if (horas_disponibles[i]["cancelled"] === true) {
                 $(event_card).css({
                     "border-left": "10px solid #FF1744"
                 });
                 event_count = $("<div class='event-cancelled'>Cancelled</div>");
             }*/
            $(event_card).append(event_name).append(event_count);
            $(".events-container").append(event_card);
        }
    }

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