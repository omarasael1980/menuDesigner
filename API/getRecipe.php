<?php
function getRecipe($id){
$get_data = callAPI('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $id, false);
     $response = json_decode($get_data, true);
     $infoMeal = $response["meals"][0];
    return  $infoMeal;
}
?>