
<?php

// Check if the 'recetas' key is present in the POST data
if (isset($_POST['recetas'])) {
    // SE RECUPERA LAS RECETAS DEL LOCALSTORAGE
    $recetas = $_POST['recetas'];

    // SE DECODIFICAN
    $data = json_decode($recetas, true);

    // Si data es null se manda mensaje a la pantalla
    if ($data === null) {
        // JSON decoding failed
        echo 'Error decoding JSON data.';
    } else {
        // JSON decoding successful
        // imprime resultado en pantalla
       
        //recorrer un array con las categorias y los limites
        $categoryLimits []= array("Beef"=>5, "Chicken"=>5,"Seafood"=>2, "Dessert"=>5, "Starter"=>2,"Breakfast"=>2);
        foreach($category as $cat ){
            print($cat->key);
        }
        //por cada registro encontrado se toma el id, se llama a la api para recuperar la receta
        //la receta se pasa a un array
        // se manda llamar para guardar la receta

        //una vez guardadas las recetas se procede a guardar el menu, que lleva un array con las recetas incluidas en el menu de la semana




    }
} else {
    // 'recetas' key is not present in the POST data
    echo 'No data received.';
}
?>
