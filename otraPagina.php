<?php

function mostrarPagina(){
  $tiempo=date('Y m d H:i:s', $_SESSION['instante']);
  $usuario=$_SESSION['usuario'];
  $tipo=$_SESSION['tipo'];

  $pagina=<<<PAGINA
    <span>Usuario: </span><span style=color:red>{$usuario}</span> 
    <span>Tipo: </span><span style=color:red>{$tipo}</span> 
    <span>Inicio Sesion: </span><span style=color:red>{$tiempo}</span> 
    <br><a href="logout.php"> Cerrar Sesion</a>
    <br><a href="principal.php"> Volver a la página Principal</a>
    <h3>AHORA ESTÁS EN OTRA PÁGINA</h3><br/>
PAGINA;
  echo $pagina;
}

function main(){
  session_start(); 
  if(isset($_SESSION['usuario'])==FALSE){
      header("Location: login.html");
  }
  mostrarPagina();  
}
main();

?>