<?php
    include_once '../helpers/cURL.php';
    include_once '../helpers/postZoho.php';
    /* Esta funcion recibe el idMeal y la categoria, y esta funcion consulta la API
     recibe los datos  y los manda a guardar a Zoho*/
    function sendRecipe($idmeal ) {
        $get_data = callAPI('GET', 'https://www.themealdb.com/api/json/v1/1/lookup.php?i=' . $idmeal, false);
        $response = json_decode($get_data, true);
        //$infoMeal = $response["meals"][0];
        $receta=$response["meals"][0];
        //eliminar datos que no necesitamos
        if(array_key_exists("strImageSource", $receta)){
            unset($receta["strImageSource"]);
        }
        if(array_key_exists("strCreativeCommonsConfirmed", $receta)){
            unset($receta["strCreativeCommonsConfirmed"]);
        }
        if(array_key_exists("dateModified", $receta)){
            unset($receta["dateModified"]);
        }
        
        $res= sendDataZoho("recetas", "1000.98e653edc3591384d1e3ba33c7752c8c.c3b447637ad59551365354e85767eb07", $receta);
      return $res;
         

}
     

    
?>

 