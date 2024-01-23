<?php
 

function mostrarAlimento($id, $nombre, $thumb) {
    // Mostrar el platillo recibido
    $html = '<div class="card text-center m-2" id="' . $id . '" style="width: 18rem;">';
    $html .= '<img src="' . $thumb . '" class="card-img-top pt-2" alt="Thumbnail">';
    $html .= '<div class="card-body">';
    $html .= '<h5 class="card-title text-center">' . $nombre . '</h5>';

    // Botón para abrir el modal
    $html .= '<button class="btn btn-primary mx-auto" type="button" data-toggle="modal" data-target="#myModal' . $id . '">';
    $html .= 'Ver Más';
    $html .= '</button>';

   
    $html .= '</div>';
    $html .= '</div>';

    // Imprimir la card y el modal
    echo $html;
}
?>
