<?php
function iniciarSesion($usuario,$tipo){    
    $_SESSION['usuario']  = $usuario;
    $_SESSION['tipo'] = $tipo;
    $_SESSION['instante']   = time();
}
function loguear (){
    // AQUI consultar a la BASE DE DATOS par ver si existe ussuario y pass
    //      consultar a partir de los datos obtenidos del formulario $_REQUEST['usuario']
    $pass='1234';                 // obtengo de la BD el pass correspondiente 
    $tipo='admin';                // obtengo de la BD el tipo de usuario   
    if ( $_REQUEST['pass']==$pass){                
        iniciarSesion($_REQUEST['usuario'],$tipo);
    }     
}
function main(){
    session_start();
    if(isset($_SESSION['usuario'])){
        header("Location: principal.php");
    }else{
        if (isset($_REQUEST['usuario'])&& isset($_REQUEST['pass']) ) {            
            loguear ();   
            header("Location: principal.php");  
        }
    }     
}
main();
?>