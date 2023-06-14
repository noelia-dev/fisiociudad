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
      $('#fecha_finlabel').toggleClass('d-none');
   });

   document.addEventListener('DOMContentLoaded', function () {
      var deleteLinks = document.getElementsByClassName('delete-link');
      var deleteConfirmButton = document.getElementsByClassName('delete-confirm')[0];
      Array.from(deleteLinks).forEach(function (link) {
         link.addEventListener('click', function (event) {
            event.preventDefault();
            var postId = this.getAttribute('data-id');
            deleteConfirmButton.setAttribute('data-id', postId);
         });
      });
      deleteConfirmButton.addEventListener('click', function () {
         var postId = this.getAttribute('data-id');
         // Aquí puedes hacer una petición AJAX para eliminar el post utilizando el ID
         // o redireccionar al controlador para eliminar el post
         console.log('Eliminar post con ID: ' + postId);
         // Cierra el modal de confirmación
         var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
         deleteModal.hide();
      });
   });
   //Comprobamos si estaba seleccionada la opción periodo
   //Ocultar o mostrar la fecha final
   if ($('#check_periodo').prop('checked')==false) {
      $('#fecha_fin').addClass('d-none');
      $('#fecha_finlabel').addClass('d-none');
   } else {
      $('#fecha_fin').removeClass('d-none');
      $('#fecha_finlabel').removeClass('d-none');
   }
});