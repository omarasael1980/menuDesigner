<?php
function insertarUsuario($nombre, $apaterno, $amaterno, $username, $pass, $rol, $dom, $tel,$cel){
 

 //recuperar 
     $query1 = "select * from usuario where user = :username";//procedimiento select_buscarUsuario(user); no sirve por codigo 1267 illegal mix of collations
     $stm = $pdo->prepare($query1);
     $stm->bindParam(':username',$username);
     $stm->execute() or die($stm->errorInfo());

     if($stm->rowCount()>0){
       exit('Este usuario ya existe');
     }
     $query= "CALL insert_nuevoUsuario(:nombre, :apaterno, :amaterno, :username, :pass,:rol,:dom,:tel,:cel);";
     
    
     $consulta= $pdo->prepare($query);
     $pass =password_hash($pass, PASSWORD_BCRYPT);
     $consulta->bindparam(":nombre",$nombre);
     $consulta->bindparam(":apaterno",$apaterno);
     $consulta->bindparam(":amaterno",$amaterno);
    $consulta->bindparam(":username",$username);
     $consulta->bindparam(":pass",$pass);
     $consulta->bindparam(":rol",$rol);
     $consulta->bindparam(":dom",$dom);
     $consulta->bindparam(":tel",$tel);
     $consulta->bindparam(":cel",$cel);
     $consulta->execute() or die (implode( " >> ", $consulta->errorInfo()));
     if($consulta->rowCount()>0){
               return true;
     }else{
       return false;
     }

}?>