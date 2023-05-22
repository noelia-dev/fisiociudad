$(document).ready(function () {
   //@TODO $('.select2').select2();

   $(".seleccionable").click(function () {
      $elemento = $(this).toggleClass("selected");
      let valor = $(this).data('id');
      //Seleccionamos el checkbox oculto como seleccionado o no
      $('input[name="selected_ids[]"][value="' + valor + '"]')[0].checked = !$('input[name="selected_ids[]"][value="' + valor + '"]')[0].checked;

   });

   $("#fechasSeleccion").submit(function (e) {
      let mensaje = '¿Está seguro que desea eliminar las siguientes fechas?\n';
      var formData = $(this).serializeArray();
      // Acceder a los valores enviados
      let mensaje_fechas = '';
      let existe_elementos = false;
      formData.forEach(function (field) {
         existe_elementos = true;
         mensaje_fechas += field.value + '\n';
         //console.log(field.name + ': ' + field.value);
      });
      if (existe_elementos) {
         mensaje += mensaje_fechas;
         //console.log(mensaje_fechas);
         if (!confirm(mensaje)) {
            e.preventDefault();
         }
      }
   });

   $("#check_periodo").click(function (e) {
      //Ocultamos/mostramos la fecha final para el periodo.
      $('#fecha_fin').toggleClass('d-none');

   });
});