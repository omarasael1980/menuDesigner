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

    // Evento al hacer clic en el botón "Agregar" dentro del modal
    $('.modal').on('click', '.btn-save', function() {
        var modalID = $(this).closest('.modal').attr('id'); // Obtener el ID del modal actual

        // Obtener datos del modal
        var categoria = $("#" + modalID + " .m-categorie").text().replace('Categoría:', '').trim();
        var mealId = $("#" + modalID + " .modal-title").data('meal-id'); // Use a data attribute to store the meal ID
        var area = $("#" + modalID + " .m-area").text().replace('Área:', '').trim();
        var tags = $("#" + modalID + " .m-m-tags").text().replace('Tags:', '').trim();
        var youtube = $("#" + modalID + " .m-youtube").html().replace('<strong>Youtube:</strong> ', '').trim();
        var source = $("#" + modalID + " .m-source").html().replace('<strong>Fuente:</strong> ', '').trim();
        var instrucciones = $("#" + modalID + " .modal-instrucciones").html().replace('<p><strong>Instrucciones:</strong> ', '').replace('</p>', '').trim();
        var meal = $("#" + modalID + " .modal-title").text().trim();

        // Obtener el límite permitido para la categoría actual desde la lista
        var limitePorCategoria = 0;
        for (var i = 0; i < listaRecetas.length; i++) {
            if (listaRecetas[i][categoria]) {
                limitePorCategoria = listaRecetas[i][categoria];
                break; // No es necesario seguir buscando
            }
        }

        // Verificar si se alcanzó el límite permitido por categoría
        if (recetasSeleccionadasPorCategoria[categoria] && recetasSeleccionadasPorCategoria[categoria].length >= limitePorCategoria) {
            alert("Ya elegiste todos los alimentos de esta categoría");
            // No recargar la página, solo cerrar el modal
            $(this).closest('.modal').modal('hide');
        } else {
            // Verificar si ya existe un elemento con el mismo ID en la categoría
            var existingRecipe = recetasSeleccionadasPorCategoria[categoria] ? recetasSeleccionadasPorCategoria[categoria].find(function (receta) {
                return receta.id === modalID;
            }) : undefined;

            if (existingRecipe) {
                // Si ya existe, mostrar alerta y no agregar la receta
                alert("Este alimento ya se ingresó a la lista, debes seleccionar otro.");
                // No recargar la página, solo cerrar el modal
                $(this).closest('.modal').modal('hide');
            } else {
                // Crear objeto de receta
                var receta = {
                    id: modalID,
                    mealId: mealId,
                    meal: meal,
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
                window.location.reload();
            }
        }
    });

    // Cargar las recetas almacenadas en localStorage al cargar la página
    var recetasLocalStorage = localStorage.getItem('recetasSeleccionadas');
    if (recetasLocalStorage) {
        recetasSeleccionadasPorCategoria = JSON.parse(recetasLocalStorage);
    }
});
