$(document).ready(function () {
   //@TODO $('.select2').select2();


   $(".seleccionable").click(function () {
      $(this).toggleClass("selected");
   });


   $(".seleccionable").click(function () {
      var seleccionados = [];
      $(".seleccionable.selected").each(function () {
         var valor = $(this).text().trim();
         seleccionados.push(valor);
      });
      console.log(seleccionados);
   });
});