<?php
include '../../helpers/checkSessionTime.php';
// Llama a la función para verificar el tiempo de sesión
checkSessionTime();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menús Semanales</title>
    <link rel="stylesheet" href="../../css/stylesVistas.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
     
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

      
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <?php if(isset($_SESSION['user'])):?>

              
<div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
        <?php if($_SESSION["user"]['rol']=="Chef"):?>
        <li class="nav-item">
            <a class="nav-link" href="../chefsviews/menuDesign.php">Diseño de Menú</a>
        </li>
        <?php elseif ($_SESSION['user']['rol']=='Almacén'):?>
        <li class="nav-item">
            <a class="nav-link" href="../storeview/checkIngredientes.php">Verificar Ingredientes</a>
        </li>
        <?php elseif ($_SESSION['user']['rol']=='Dueño'):?>
        <li class="nav-item">
        <a class="nav-link" href="../ownerview/authorizeMenu.php">Autorizar Menú</a>
        </li>
        <?php endif?>
    </ul>
</div>
<div class="col-2 col-md-2 col-sm-12 col-xs-12 "> <a class="nav-button-logout" href="  ../../controllers/logout.php"> LogOut</a></div>
<?php endif?>
            </div>
        </nav>
 
