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
      formData.forEach(function (field) {
         mensaje_fechas += field.value + '\n';
         //console.log(field.name + ': ' + field.value);
      });
      mensaje += mensaje_fechas;
      //console.log(mensaje_fechas);
      if (!confirm(mensaje)) {
         e.preventDefault();
      }
   });
});