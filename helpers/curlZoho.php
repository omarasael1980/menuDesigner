<?php 
function getDataZoho($reporte, $token){
  // Ahora puedes acceder a las variables de entorno
//$token = "1000.9b78f8e345dca2a23b99ed6f0725d263.a9e7e4ab7708adbab733d4505e32a4ce";
$environment = "development";
$url_base = "https://creator.zoho.com/api/v2/omarasael80/menucreator/report/".$reporte;
//echo $url_base;
 
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
 
    $dataresult = ($data);
    return $dataresult;
}
}
?>