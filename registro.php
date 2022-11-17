<?php

$db_host = "localhost";
$db_nombre = "hotel";
$db_usuario = "root";
$db_contra = "root"; 

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre); 

mysqli_set_charset($conexion, "utf8");

mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la base de datos");


// CÓDIGO ADAPTADO DE (https://www.youtube.com/watch?v=CxkR05XAJYA)

$nombre   = $_GET['nombre'];
$apellido = $_GET['apellido'];
$dni      = $_GET['dni'];
$telefono = $_GET['telefono'];
$email    = $_GET['email'];
$usuario  = $_GET['usuario'];
$pass     = $_GET['pass'];
$confPass = $_GET['confpass'];
// FALTA AGREGAR EL ROL, QUE ES CLAVE FORÁNEA CON LA TABLA ROL

$reqlen   = strlen($nombre)*strlen($apellido)*strlen($dni)*strlen($telefono)*strlen($email)*strlen($usuario)*strlen($pass);
/* 1ª paso para hacer que los campos sean requeridos. Multiplicamos el largo de todos los campos (string) x0 porque
si uno está vacío, va a hacer que toda la cuenta de 0, lo cual quiere decir que la persona no rellenó alguno de los campos*/

if($reqlen>0){ // Si el producto anterior es mayor a 0 (o sea, todos los campos fueron completados)

    if($pass===$confPass){ // Y si la contraseña y su confirmación son iguales
               
        // va a insertar un nuevo registro en la base de datos
        $consulta = "INSERT INTO usuarios (nombre,apellido,dni,telefono,mail,usuario,pass) VALUES
        ('$nombre','$apellido',$dni',$telefono',$email',$usuario',$pass')"; // Faltó agregar el ROL

        $resultados = mysqli_query($conexion, $consulta);

        if($resultados == false){

            echo "Ha ocurrido un error en registrar los datos";

        }else{

            echo "Se han registrado con éxito sus datos"; // Debería estar dentro del MODAL
            //Aunque estaría bueno mandarlo a index con la sesión iniciada con el usuario que ya se creó
        }
        
    }else{ // Si las contraseñas ingresadas NO son iguales: ERROR
        echo 'Las contraseñas ingresadas no coinciden'; // Debería estar dentro del MODAL
    }

}else{ // Si el producto NO es mayor a 0 (o sea, algún campo no fue completado): ERROR
    echo 'Por favor, complete todos los campos del formulario de registro'; // Debería estar dentro del MODAL
}

?>