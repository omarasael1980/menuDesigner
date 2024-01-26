

<?php
//Bruno6502?   brunochavez  | hugomontoya Hugo6502? |ramirolozano  Ramiro6502?

if(!isset($_SESSION)){
    session_start();
}
include '../helpers/curlZoho.php';

$usuario = $_POST['usuario'];
$password = $_POST['password'];
$respuesta = null;
echo $usuario;
echo $password;
// Buscar usuario por usuario desde Zoho
$users = getDataZoho("usuarios_Report", "1000.6636be38bbff4e949a2cad3b8418991b.a7aced882307381095f7538c8c63020e");
  
foreach ($users['data'] as $user) {
    if ($user['user'] == $usuario) {
        if (password_verify($password, $user['pass'])) {
            // Construcción de array sesión
            $sesion = array(
                "name" => $user['Name']['first_name']." ".$user['Name']['last_name'],
                "rol" => $user['rol']
            );
            $_SESSION['user'] = $sesion;
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
?>
