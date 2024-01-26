<?php
//funcion que reccibe un pass y regresa el pass hasheado
function encriptaPass($pass){
    return $pass =password_hash($pass, PASSWORD_BCRYPT);

}
 