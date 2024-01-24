// Obtener el objeto de localStorage
var recetasSeleccionadasPorCategoria = JSON.parse(localStorage.getItem('recetasSeleccionadas'));

// Lista de objetos  para limitar las elecciones con el formato [{"Beef":5},{"Chicken":5},{"Seafood":3}]
var listaRecetas = [{"Beef":5},{"Chicken":5},{"Seafood":2}, {"Dessert":5}, {"Starter":2},{"Breakfast":2}];

// Función para generar HTML a partir del objeto de recetas
function generarHTMLRecetasSeleccionadas(recetasPorCategoria, listaRecetas) {
    // Verificar si hay recetas seleccionadas
    if (recetasPorCategoria && Object.keys(recetasPorCategoria).length > 0) {
        var html = '<h3 class="text-center  mb-4">Haz seleccionado:</h3>';

        // Iterar a través de las categorías en la lista
        for (var i = 0; i < listaRecetas.length; i++) {
            var categoriaObj = listaRecetas[i];
            var categoria = Object.keys(categoriaObj)[0];
            var cantidadDeseada = categoriaObj[categoria];

            // Verificar si la categoría existe en las recetas seleccionadas
            if (recetasPorCategoria.hasOwnProperty(categoria)) {
                var recetasCategoria = recetasPorCategoria[categoria];
                var cantidadActual = recetasCategoria.length;

                html += '<p><strong>Categoría ' + categoria + ':</strong> ' + cantidadActual + ' de ' + cantidadDeseada + '</p>';
                html += '<ul>';

                // Iterar a través de las recetas de la categoría
                recetasCategoria.forEach(function(receta) {
                    html += '<li>' + receta.meal + '</li>';
                });

                html += '</ul>';
            } else {
                // Si la categoría no está presente en las recetas seleccionadas
                html += '<p>Categoría ' + categoria + ': 0 de ' + cantidadDeseada + '</p>';
            }
        }

        return html;
    } else {
        return '<p>No hay recetas seleccionadas.</p>';
    }
}

// Obtener el div con la clase "seleccionados"
var divSeleccionados = document.querySelector('.seleccionados');

// Generar y agregar el HTML al div
divSeleccionados.innerHTML = generarHTMLRecetasSeleccionadas(recetasSeleccionadasPorCategoria, listaRecetas);
