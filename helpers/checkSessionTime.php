<?php

function checkSessionTime() {
    session_start();

    // Verificar si la sesión está iniciada
    if (isset($_SESSION['start_time'])) {
        // Verificar si ha pasado más de 50 minutos desde el inicio de la sesión
        if (time() - $_SESSION['start_time'] > 3000) {
            // 3000 segundos = 50 minutos
            session_unset();     // Limpiar todas las variables de sesión
            session_destroy();   // Destruir la sesión
            header("Location: ../login.php?tipo=info&&msg=Tu sesión ha expirado"); // Redirigir a la página de inicio de sesión
            exit();
        }
    } else {
        // Si la sesión no está iniciada, redirigir a la página de inicio de sesión
        header("Location: ../login.php?tipo=info&&msg=Inicia sesión para continuar");
        exit();
    }
}
?>
