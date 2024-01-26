<?php
 
// Ahora puedes acceder a las variables de entorno
$token = $_SESSION['token'];
$environment = "development";
$url_base = "https://creator.zoho.com/api/v2/omarasael80/menucreator/report/All_Categories";

 
 
$ch = curl_init($url_base);

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Zoho-oauthtoken ' . $token,
    'environment: ' . $environment
    
));

// Ejecutar la solicitud cURL y obtener la respuesta
$response = curl_exec($ch);

// Verificar si hay errores
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
}

// Cerrar la sesión cURL
curl_close($ch);

// Convertir el string JSON a un array asociativo
$data = json_decode($response, true);
 
// Verificar si la decodificación fue exitosa
if ($data === null) {
    echo 'Error al decodificar JSON';
} else {
    // Procesar el array asociativo (puede imprimirlo, manipularlo, etc.)
 
    $categorias = ($data["data"]);
    foreach($categorias as $cat){
        print_r($cat["strCategory"]);
    }
}
?>
