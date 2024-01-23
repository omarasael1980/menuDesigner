 
    <!-- Se cargan datos de la API:https://www.themealdb.com/api/json/v1/1/categories.php  -->
    <!--Estructura de los datos 
        "idCategory": "1",
      "strCategory": "Beef",
      "strCategoryThumb": "https://www.themealdb.com/images/category/beef.png",
      "strCategoryDescription": "Beef is the culinary name for meat from cattle, particularly skeletal muscle. Humans have been eating beef since prehistoric times.[1] Beef is a source of high-quality protein and essential nutrients.[2]" -->
 
      <?php

function getCategories() {
    // Inicializar la conexión cURL
    $ch = curl_init();
    
    // Definir la URL de la API
    $URL_API_CAT = "https://www.themealdb.com/api/json/v1/1/categories.php";
    
    // Configurar opciones de cURL
    curl_setopt($ch, CURLOPT_URL, $URL_API_CAT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // Ejecutar la solicitud cURL
    $response = curl_exec($ch);
    
    // Verificar errores en la conexión cURL
    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        $error = "Error al conectarse con la API \n" . $error_msg;
        // Devolver un array asociativo con el estado y el mensaje de error
        return ['status' => 400, 'message' => $error];
    } else {
        // Cerrar la conexión cURL
        curl_close($ch);
        
        // Decodificar la respuesta JSON
        $categories_data = json_decode($response, true);
        
        // Devolver un array asociativo con el estado y los datos de categorías
        return ['status' => 200, 'message' => $categories_data["categories"]];
    }
}



?>
