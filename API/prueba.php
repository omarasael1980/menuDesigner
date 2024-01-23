<?php
include '../helpers/cURL.php';
$get_data = callAPI('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=52772', false);
$response = json_decode($get_data, true);
 
?>
 <pre>
    <?php
    print_r($response["meals"][0]);
    ?>
 </pre>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   </head>
    <body>
       
    </body>
</html><?php
 

 function mostrarAlimento($id, $nombre, $thumb) {
     // Solicitar info de cada receta a la API
     $get_data = callAPI('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $id, false);
     $response = json_decode($get_data, true);
     $infoMeal = $response["meals"][0];
 
     // Mostrar el platillo recibido
     $html = '<div class="card text-center m-2" id="' . $id . '" style="width: 18rem;">';
     $html .= '<img src="' . $thumb . '" class="card-img-top pt-2" alt="Thumbnail">';
     $html .= '<div class="card-body">';
     $html .= '<h5 class="card-title text-center">' . $nombre . '</h5>';
 
     // Botón para expandir la card
     $html .= '<button class="btn btn-primary mx-auto" type="button" data-toggle="collapse" data-target="#collapse' . $id . '" aria-expanded="false" aria-controls="collapse' . $id . '">';
     $html .= 'Ver Más';
     $html .= '</button>';
 
     // Contenedor colapsable con información adicional
     $html .= '<div class="collapse" id="collapse' . $id . '">';
     $html .= '<div class="card card-body">';
     
     // Detalles adicionales
     $html .= '<p><strong>Área:</strong> ' . $infoMeal['strArea'] . '</p>';
     $html .= '<p><strong>Instrucciones:</strong> ' . $infoMeal['strInstructions'] . '</p>';
     $html .= '<p><strong>YouTube:</strong> <a href="' . $infoMeal['strYoutube'] . '" target="_blank">' . $infoMeal['strYoutube'] . '</a></p>';
     
     $html .= '</div>';
     $html .= '</div>';
 
     $html .= '</div>';
     $html .= '</div>';
 
     // Imprimir la card con información adicional
     echo $html;
 }
 ?>
 $(document).ready(function() {
 
 // Lista global para almacenar las recetas seleccionadas por categoría
 var recetasSeleccionadasPorCategoria = {};

// Obtener la URL de la API desde un parámetro
var apiURL = "https://www.themealdb.com/api/json/v1/1/lookup.php?i=";

// Función para cargar la información de la API al abrir el modal
function cargarInfoAPI(id, modalID) {
   var url = apiURL + id;
   $.ajax({
       url: url,
       type: 'GET',
       success: function(response) {
           $("#" + modalID + " .m-categorie").html('<strong>Categoría:</strong> ' + response.meals[0]["strCategory"]);
           $("#" + modalID + " .m-area").html('<strong>Área:</strong> ' + response.meals[0]["strArea"]);
           $("#" + modalID + " .m-m-tags").html('<strong>Tags:</strong> ' + response.meals[0]["strTags"]);
           $("#" + modalID + " .m-youtube").html('<strong>Youtube:</strong> ' + response.meals[0]["strYoutube"]);
           $("#" + modalID + " .m-source").html('<strong>Fuente:</strong> ' + response.meals[0]["strSource"]);
           $("#" + modalID + " .modal-instrucciones").html('<p><strong>Instrucciones:</strong> ' + response.meals[0]["strInstructions"] + '</p>');
           
       },
       error: function(error) {
           console.error('Error al cargar la información de la API:', error);
       }
   });
}
// Evento al abrir cualquier modal
$('.modal').on('show.bs.modal', function(event) {
var button = $(event.relatedTarget); // Botón que activó el modal
var id = button.closest('.card').attr('id'); // Obtener el ID de la card
var modalID = $(this).attr('id'); // Obtener el ID del modal actual

// Cargar la información de la API al abrir el modal
cargarInfoAPI(id, modalID);
});
$('.modal').on('click', '.btn-save', function() {
   alert("Alimento registrado");
   var modalID = $(this).closest('.modal').attr('id'); // Obtener el ID del modal actual

   // Obtener datos del modal
   var categoria = $("#" + modalID + " .m-categorie").text().replace('Categoría:', '').trim();
   var area = $("#" + modalID + " .m-area").text().replace('Área:', '').trim();
   var tags = $("#" + modalID + " .m-m-tags").text().replace('Tags:', '').trim();
   var youtube = $("#" + modalID + " .m-youtube").text().replace('Youtube:', '').trim();
   var source = $("#" + modalID + " .m-source").text().replace('Fuente:', '').trim();
   var instrucciones = $("#" + modalID + " .modal-instrucciones").text().replace('Instrucciones:', '').trim();
   
   // Crear objeto de receta
   var receta = {
       id: modalID,
       categoria: categoria,
       area: area,
       tags: tags,
       youtube: youtube,
       source: source,
       instrucciones: instrucciones
   };
    
   // Verificar si la categoría ya tiene un arreglo en localStorage
   if (!recetasSeleccionadasPorCategoria[categoria]) {
       recetasSeleccionadasPorCategoria[categoria] = [];
   }

   // Agregar receta al arreglo de la categoría
   recetasSeleccionadasPorCategoria[categoria].push(receta);

   // Almacenar la lista en localStorage
   localStorage.setItem('recetasSeleccionadas', JSON.stringify(recetasSeleccionadasPorCategoria));
   
   // Cerrar el modal
   $(this).closest('.modal').modal('hide');

   // Puedes hacer lo que quieras con la lista de recetas seleccionadas, por ejemplo, imprimir en la consola
   console.log("Recetas Seleccionadas por Categoría:", recetasSeleccionadasPorCategoria);
});

// Cargar las recetas almacenadas en localStorage al cargar la página
var recetasLocalStorage = localStorage.getItem('recetasSeleccionadas');
if (recetasLocalStorage) {
   recetasSeleccionadasPorCategoria = JSON.parse(recetasLocalStorage);
   console.log(recetasLocalStorage);
}
});