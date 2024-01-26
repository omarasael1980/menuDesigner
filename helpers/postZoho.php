<?php 
 

function sendDataZoho($form, $token, $datos){
  // Ahora puedes acceder a las variables de entorno
 
$environment = "development";
$url_base = "https://creator.zoho.com/api/v2/omarasael80/menucreator/form/".$form;
 
 
$ch = curl_init($url_base);
$datos_json = json_encode(array("data" => $datos));
if($form =="CapturaMenu"){
    echo 'Se envia a ';
    echo $form;
    echo $datos_json;
}

// Configurar las opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datos_json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Zoho-oauthtoken ' . $token,
        'environment: ' . $environment
        
    ));
// Ejecutar la solicitud cURL y obtener la respuesta
$response = curl_exec($ch);
$response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error al enviar la solicitud: ' . curl_error($ch);
    }

    curl_close($ch);

    // Regresa la respuesta del servidor
    
    return $response;
}

?>