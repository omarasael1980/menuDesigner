<?php
 if(!isset($_SESSION)){
    session_start();
}
?>
 
 
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Mi Sitio Web</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <script
	  src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
 
	 
</head>

<body>
   
     
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
               
                <?php if(isset($_SESSION['user'])):?>

              
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php if($_SESSION["user"]['rol']=="Chef"):?>
                        <li class="nav-item">
                            <a class="nav-link" href="views/chefsviews/menuDesign.php">Diseño de Menú</a>
                        </li>
                        <?php elseif ($_SESSION['user']['rol']=='Almacén'):?>
                        <li class="nav-item">
                            <a class="nav-link" href="views/storeview/checkIngredientes.php">Verificar Ingredientes</a>
                        </li>
                        <?php elseif ($_SESSION['user']['rol']=='Dueño'):?>
                        <li class="nav-item">
                        <a class="nav-link" href="views/ownerview/authorizeMenu.php">Autorizar Menú</a>
                        </li>
                        <?php endif?>
                    </ul>
                </div>
                <div class="col-2 col-md-2 col-sm-12 col-xs-12 "> <a class="nav-button-logout" href="  controllers/logout.php"> LogOut</a></div>
                <?php endif?>
            </div>
        </nav>
    
<!-- Aqui Inicia LOGin -->
<!--AQui inicia todo el formulario de login-->
 
<?php if(!isset($_SESSION['user'])):?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-3 col-xs-0"></div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
          <br><br><br>
            <form action="controllers/login.php" class="form-control formulario" id="formulario" method='post'autocomplete="off">
                <div class="form-group" >
                    <div class="row">
                         <center><a href=""><img class=" img-menu" 
                         src="img/icons/cocinero.png" alt="usuario">  </a> </center>
                    </div> 
                    
                 <div class="row"> 
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><center><h1 class="">Ingresar </h1></center></div>
               
                         </div>
                   
                </div>
                <div class="form-group  " id="grupo__usuario">
                     
                        <div class="form-group-input  ">
                        <label for="usuario" class="form-label form-control"> <b> Usuario:</b>
                             <input class="  img-container " type="text" name="usuario" placeholder="ChefAntonio">
                             <i class=""><img class="form-validation-state img-input" id="img-usuario"src="img/icons/cross.png" alt="incorrecto"> </i>
                        </div>
                        </label>
                   <div class="form-message" id="mensaje_error__usuario">
                    <p>Escribe tu usuario, debe contener entre 4-12 caracteres</p>
                   </div>
                </div>
                    <br>
                <div class="form-group  " id="grupo__password">
                     
                     <div class=" form-group-input ">
                     <label for="password" class="form-label form-control"> <b> Contraseña:</b>
                          <input class="  img-container " type="password" name="password" placeholder="********">
                          <i class=""><img class="form-validation-state img-input" src="img/icons/cross.png" alt="incorrecto"> </i>
                     </div>
                     <div class="form-message form-message" id="mensaje_error__password">
                    <p>Debe tener al menos una mayúscula, minuscula y un número, longitud mínima de 8 caracteres</p>
                   </div>
                     </label>
                     <br>
                     <br>
                     <div class="form-message  me_formulario" id="mensaje_error__formulario">
                    <p><center> <b><h3>Debes llenar todos los campos</h3></b></center> </p>
                   </div>
                   <?php if(isset($_GET['tipo'])):?>
                        
                        <div class="form-message  me_formulario-active" id="mensaje_error__formulario">
                    <p><center> <b><h3><?=$_GET['msg']?></h3></b></center> </p>
                    
                   
                   </div>
                        <?php endif?>
             </div>
            
                
                <br>
                <button type="submit" class="btn btn-primary form-control" id="entrar">Entrar</button>
               
               
            </form>
            
        </div>
       
    </div>
</div>
<!--AQui inicia todo el contenido menu principal-->
<!--Si esta logueado el usuario se muestra el menu principal Sino se manda a login-->


    <?php endif?>
    <?php if(isset($_SESSION['user'])):?>
    <div class="row">
        <center><h1>Bienvenido <?=$_SESSION['user']['name']?></h1></center>
    </div>
        <?php endif?>
        
    </div>
    </div>
    <script src="js/validaciones.js">        </script>
<!-- Termina Login -->
    <!-- Bootstrap JS y Popper.js (Requeridos para los componentes de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
