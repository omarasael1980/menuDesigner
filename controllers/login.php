

<?php
//Bruno6502?   brunochavez  | hugomontoya Hugo6502? |ramirolozano  Ramiro6502?

if(!isset($_SESSION)){
    session_start();
}
include '../helpers/curlZoho.php';
include '../helpers/refreshZoho.php';
$usuario = $_POST['usuario'];
$password = $_POST['password'];
$respuesta = null;
echo $usuario;
echo $password;
$rtok = refreshZohoSession();
// Buscar usuario por usuario desde Zoho
$users = getDataZoho("usuarios_Report", $rtok);
  
foreach ($users['data'] as $user) {
    if ($user['user'] == $usuario) {
        if (password_verify($password, $user['pass'])) {
            // Construcción de array sesión
            $sesion = array(
                "name" => $user['Name']['first_name']." ".$user['Name']['last_name'],
                "rol" => $user['rol']
            );
            $_SESSION['user'] = $sesion;
            // Establecer el tiempo de inicio de la sesión
            $_SESSION['start_time'] = time();
            //Refrescar el token de Zoho
            $_SESSION['token'] =$rtok;
            $respuesta = 1;
            $error = array("tipo" => 'success', "msg" => 'Bienvenido');
        } else {
            // Contraseña incorrecta
            $error = array("tipo" => 'error', "msg" => 'El password es incorrecto');
            $respuesta = 2;
        }
    } else {
        $error = array("tipo" => 'error', "msg" => 'El usuario no existe');
        $respuesta = 3; // El usuario no existe
    }
}

$_SESSION['msg'] = $error;
$tipo = $error['tipo'];
$msg = $error['msg'];

header("Location: ../?tipo=".$tipo."&&msg=".$msg);
// Verificar si ha pasado más de 50 minutos desde el inicio de la sesión
if (isset($_SESSION['start_time']) && (time() - $_SESSION['start_time'] > 3000)) {
    // 3000 segundos = 50 minutos
    session_unset();     // limpiar todas las variables de sesión
    session_destroy();   // destruir la sesión
    header("Location: ../login.php?tipo=info&&msg=Tu sesión ha expirado"); // redirigir a la página de inicio de sesión
    exit();
}
?>
