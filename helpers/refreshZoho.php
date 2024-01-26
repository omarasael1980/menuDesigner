<?php

define('ZOHO_REFRESH_TOKEN', '1000.0ac23888cf1879e75f6ef0b3c2024b9d.382bfef981b77cebc22be58e9bc870c5');
define('ZOHO_CLIENT_ID', '1000.DKX3I50FMQ10OTIZJLLK82GKHVFUGG');
define('ZOHO_CLIENT_SECRET', 'd4b327aac39d566e35b526517250c070dec157a1f5');

function refreshZohoSession() {
    $url = "https://accounts.zoho.com/oauth/v2/token?refresh_token=" . urlencode(ZOHO_REFRESH_TOKEN) . "&client_id=" . urlencode(ZOHO_CLIENT_ID) . "&client_secret=" . urlencode(ZOHO_CLIENT_SECRET) . "&grant_type=refresh_token";

   
$ch = curl_init($url);
 
    // Configurar las opciones de cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
     
   
// Ejecutar la solicitud cURL y obtener la respuesta
    $response = curl_exec($ch);
   

    $data = json_decode($response, true);
    if (curl_errno($ch)) {
        echo 'Error al enviar la solicitud: ' . curl_error($ch);
    }

    curl_close($ch);

    // Regresa la respuesta del servidor
    
    return $data;
}
 
?>
 
