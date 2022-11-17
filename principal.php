<!--
CÓDIGO PHP CON HTML EMBEBIDO
-->
<?php
  include "sesion.php";
  $sesionUsuario = controlarSesion();
  
  if ($sesionUsuario!=NULL){
    // AQUI COLOCAR CONTENIDO LA PÁGINA PRINCIPAL
    
    $contenidoHTML="";
    $contenidoHTML= $contenidoHTML . '<ul class="list-inline">';
    $contenidoHTML= $contenidoHTML . '<li class="list-inline-item"> Bienvenido <strong>' . $sesionUsuario . '</strong> </li>';
    $contenidoHTML= $contenidoHTML . '<li class="list-inline-item"><a href="sesion.php?accion=cerrarSesion">Sign Out</a></li>';
    $contenidoHTML= $contenidoHTML . '<li class="list-inline-item"><a href="sign-edit.php">Sign Edit</a></li>'; 
    $contenidoHTML= $contenidoHTML . '</ul>';

  }

?>
<!--
==================================================================
-->
<!--
CÓDIGO HTML CON PHP EMBEBIDO
-->

<!DOCTYPE html>
<html>
  <head>
    <title>Principal</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

  </head>
  <body>
    <?php
      echo $contenidoHTML;
    ?>
  </body>

</html>

<!--
==================================================================
-->