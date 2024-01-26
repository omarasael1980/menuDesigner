
<?php
include_once '../controllers/guardaReceta.php';
// Check if the 'recetas' key is present in the POST data
if (isset($_POST['recetas'])) {
    // SE RECUPERA LAS RECETAS DEL LOCALSTORAGE
    $recetas = $_POST['recetas'];

    // SE DECODIFICAN
    $data = json_decode($recetas, true);
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    // Si data es null se manda mensaje a la pantalla
    if ($data === null) {
        // JSON decoding failed
        echo 'Error decoding JSON data.';
    } else {
        // JSON decoding successful
        // imprime resultado en pantalla
       /*$data es del tipo     [Seafood] => Array
        (
            [0] => Array
                (
                    [id] => myModal52959
                    [meal] => Baked salmon with fennel & tomatoes
                    [categoria] => Seafood
                )

            [1] => Array
                (
                    [id] => myModal52819
                    [meal] => Cajun spiced fish tacos
                    [categoria] => Seafood
                )

        )*/
               //recorrer un array con las categorias y los limites
      // Inicializar los arrays de conteo
$categoryconteo = [
    'Beef' => 0,
    'Chicken' => 0,
    'Seafood' => 0,
    'Dessert' => 0,
    'Starter' => 0,
    'Breakfast' => 0
];

$categoryLimits = [
    'Beef' => 5,
    'Chicken' => 5,
    'Seafood' => 2,
    'Dessert' => 5,
    'Starter' => 2,
    'Breakfast' => 2
];

foreach ($data as $cat) {
    foreach ($cat as $meal) {
        // Obtener myModal1234 donde los números son el id de la receta
        $id = str_replace("myModal", "", $meal["id"]);
        $recipeTitle = $meal["meal"];
         sendRecipe($id);
        // Incrementar el contador para la categoría de esta comida
        if (isset($categoryconteo[$meal["categoria"]])) {
            $categoryconteo[$meal["categoria"]] += 1;
        }
    }
}

 
        //una vez guardadas las recetas se procede a guardar el menu, que lleva un array con las recetas incluidas en el menu de la semana
sendWeekMenu();



    }
} else {
    // 'recetas' key is not present in the POST data
    echo 'No data received.';
}
?>
