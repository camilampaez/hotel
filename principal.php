<?php

/*********************************BASE DE DATOS**************************** */

function getStringConnection(){    
  // obtiene el string de conexión y lo retorna
  // arreglo asociativo con los datos de la conexión
  $arrSConn = array( 
      "servername"  => "localhost",
      "username"    => "root",
      "password"    => "root",
      "dbname"      => "hotel",
  );
  return $arrSConn;
}

function conectarBD() {              
  //La función realiza la conexion y la retorna 
  // obtiene el string de conexión
  $arrSConn = getStringConnection();
  // Crear conexión
    $conn = new mysqli($arrSConn["servername"],
                       $arrSConn["username"],
                       $arrSConn["password"],
                       $arrSConn["dbname"]
                      );
  // Checkear conexión
  if ($conn->connect_error) {
      die("Conexion fallida: " . $conn->connect_error);
  } 
  // retornar la conexión 
  return $conn;

}

function ejecutarSQL($conn, $sql) {  
  // realiza una consutla y retorna el resultado
  // realiza una consulta sql $sql a un coneccion $conn  
  $result = $conn->query($sql);
  // retornar el resultado
  return $result;
}

function desconectarBD($conn){       
  // desconecta la conexión a una base de datos
  // cerrar conexión
  $conn->close();
}


/*********************************PRINCIPAL************************************************************************** */

// PARA EL REGISTRO DE NUEVOS USUARIOS: CAMPOS REQUERIDOS + ENVÍO A BASE DESDE REGISTRO.PHP (https://www.youtube.com/watch?v=CxkR05XAJYA)
/*function registro(){
  if (isset($_POST['registrarme'])){ // Si está presionado el botón de name "registrarme"...
    require("registro.php"); // Llama - incluye - pide el código que va a estar en registro.php
  }
}*/

// BARRA DE NAVEGACIÓN SESIÓN INICIADA: NOMBRE ----- Pedir un campo específico de hotel.usuario.nombre para $nombre
function obtenernombre(){
  $nombre="";
  if(isset($_REQUEST["nombre"])){
    $nombre = $_REQUEST["nombre"];
  }
  return $nombre;
}

//***********HEREDOCS con divisores para sesión no iniciada (BARRANO) e iniciada (BARRASI)*******
// Función para que la BARRANO (sesión NO iniciada) te diga "iniciar sesión" + "registrarse"
function barrahtml(){
$barraNO = <<<BARRANO
        <div class="d-grid gap-2 col-3"> <!-- Derecha: iniciar sesión o registrarse -->
                            
        <span class="navbar-text">
          
          <button type="button" class="btn btn-outline-secondary"> 
              <a href="#" data-bs-toggle="modal" data-bs-target="#iniciosesion">Iniciar sesión</a> 
          </button>    
  
          <button type="button" class="btn btn-outline-secondary"> 
              <a href="#" data-bs-toggle="modal" data-bs-target="#registro">Registrarse</a>
          </button>
        </span>
  
        </div>
BARRANO;
  return $barraNO;
}

// Función para que la BARRASI (sesión iniciada) te diga "Bienvenido + nombre usuario"
function barrahtml2(){ // Acá abajo se usa la fx de obtener nombre
  $nombre=obtenernombre();
  $barraSI=<<<BARRASI
        <div class="d-grid gap-2 col-3"> <!-- Derecha: dropdown sesión iniciada -->
  
                      <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Bienvenid@ {$nombre}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                              
                              <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#perfil_huesped">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="9"></circle>
                                    <circle cx="12" cy="10" r="3"></circle>
                                    <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                  </svg>
                                Mi perfil
                              </a></li>
  
                              <li><a class="dropdown-item" href="#">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-autofit-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M20 12v-6a2 2 0 0 0 -2 -2h-12a2 2 0 0 0 -2 2v8"></path>
                                    <path d="M4 18h17"></path>
                                    <path d="M18 15l3 3l-3 3"></path>
                                  </svg>
                                  Cerrar cesión
                              </a></li>
  
                            </ul>
                          </li>
                        </ul>
                      </div>
                    </div>
BARRASI;
  return $barraSI;
}
//************************************************************************************************ */


// FUNCIÓN CON EL HEREDOC QUE MUESTRA TODA LA PÁGINA*************************************************
function mostrarPagina($tienebarra=true){
    if(isset($_SESSION['usuario'])){
      $tiempo=date('Y m d H:i:s', $_SESSION['instante']);
      $usuario=$_SESSION['usuario'];
      $tipo=$_SESSION['tipo'];
    }

    if ($tienebarra){      // Para distinguir: si es TRUE que la sesión está iniciada, 
      $barra=barrahtml2(); //te manda a función con BARRASI
    }
     
    else{                 // Si es FALSE que la inición está iniciada,
      $barra=barrahtml(); // te manda a fx con BARRANO
    }

  //HEREDOC para meter nuestro código HTML de INDEX
  $pagina=<<<PAGINA
  <!doctype html>
  <html lang="en">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Para que sea responsive, lo necesita bootstrap -->
  
      <!-- Este código es para relacionar bootstrap -->
      <title>Hotel Costa clara - Home</title>
  
            <!-- con la dirección de donde se encuentra el CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
            
            <!-- con la direcciones de programas de JavaScript-->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  
      <!-- Hay que loguerse en la pagina de fontawesome y obtener tu propio "codigo de kit"-->
      <!-- xxxxx reprenta el lugar donde bese poner el codigo de kit que te asignen.-->
      <script src="https://kit.fontawesome.com/xxxxx.js" crossorigin="anonymous"></script>
  
      <!-- Nuestra propia hoja de estilos-->
      <link href="estilos.css" rel="stylesheet" type="text/css">
  
  </head>
     
  <body>
    
    <div id="nav"><!-- Barra de navegación-->
      <div class="container .container-fluid"> 
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                
                    <a class="navbar-brand" href="index.html"> <!-- Isotipo y logotipo -->
                      <img src="imagenes/isotipo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                      Hotel Costa Clara
                    </a>
  
                    <div class="collapse navbar-collapse" id="navbarText"> <!-- Izquierda: botones -->
                          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                  <li class="nav-item">
                                    <a class="nav-link active" href="index.html">Home</a>
                                  </li>
  
                                  <li class="nav-item">
                                    <a class="nav-link" href="reservas_huesped.html">Reservar</a>
                                  </li>
                                                                  
                                  <li class="nav-item">
                                    <a class="nav-link" href="#footer">Contacto</a>
                                  </li>
                          </ul>
                    </div>
  
                    {$barra}
  
                </div>
          </nav>
      </div>
    </div>
    
    <div class="modal" id="iniciosesion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal: inicio sesión -->
      <div class="modal-dialog modal-dialog-centered">
        
        <div class="modal-content">
          
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Iniciar sesión</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
  
            <div class="modal-body">
                  <form>
                      <div class="mb-3 mx-2">
                        <label for="exampleInputEmail1" class="form-label">Usuario</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Utilizá el mail con el que te registraste</div>
                      </div>
                      <div class="mb-3 mx-2">
                        <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                      </div>
                  </form>
              
                  <p class="mx-2">¿No tenes una cuenta? <a class="link" href="index.html/registro">Registrate</a></p>
  
            </div>
  
            <div class="modal-footer mx-2">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary btn-dark">Iniciar sesión</button>
            </div>
  
        </div>
      </div>
  
    </div>
  
    <div class="modal modal-xl" id="registro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal: registro -->
      <div class="modal-dialog modal-dialog-centered">
    
        <div class="modal-content">
        
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de nuevo usuario</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
                <p class="blockquote mx-3">Para registrarse, por favor complete los siguientes campos:</p>
                
                <form method="get" action="registro.php">
                  
                    <div class="row mb-3 mx-2">
                        <div class="col-sm-6">
                          <label for="nombre_huesped" class="form-label">Nombre/s</label>
                          <input type="text" class="form-control" id="nombre_huesped" name="nombre">
                        </div>
                        <div class="col-sm-6">
                          <label for="apellido_huesped" class="form-label">Apellido/s</label>
                          <input type="text" class="form-control" id="apellido_huesped" name="apellido">
                        </div>
                    </div>

                    <div class="row mb-3 mx-2">
                      <div class="col-sm-3">
                        <label for="dni" class="form-label">Documento único de identidad</label>
                        <input type="text" class="form-control" id="dni" name="dni">
                      </div>
                    </div>

                  <div class="row mb-3 mx-2">
                      <label for="telefono" class="form-label">Número de teléfono</label>
                      <input type="text" class="form-control" id="telefono" name="telefono">
                  </div>

                    <div class="row mb-3 mx-2">
                      <div class="col-sm-6">
                        <label for="mail_huesped" class="form-label">Mail</label>
                        <input type="email" class="form-control" id="email_huesped" name="email">
                      </div>
                      <div class="col-sm-3">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                      </div>
                    </div>

                    <div class="row mb-3 mx-2">
                      <div class="col-sm-6">
                        <label for="pass_huesped" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass_huesped" name="pass">
                      </div>
                      <div class="col-sm-6">
                        <label for="conf_pass_huesped" class="form-label">Confirmar contraseña</label>
                        <input type="password" class="form-control" id="conf_pass_huesped" name="confpass">
                      </div>
                    </div>
                  
                    <div class="modal-footer mx-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <input type="submit" name="registrarme" value="Registrarme" class="btn btn-dark">
                    </div>

                </form>
          </div> <!-- Modal: body -->
        </div> <!-- Modal: content -->
      </div> <!-- Modal: container -->
    </div> <!-- Modal: registro -->
    
    <div id="imagen"> <!-- Portada -->
          <img src="imagenes/portada_edit.jpg" class="img-fluid" width="100%" height="250"role="img" aria-label="Placeholder: Responsive image" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect>
      </div>
  
      <div class="container pt-sm-3 pb-sm-3 text-center"> <!-- Título: Miramar -->
              <!-- Tamaños de padding: {property }{sides}-{breakpoint}-{size}. Para más ver en: https://getbootstrap.com/docs/4.0/utilities/spacing/-->
              <div class="row align-items-start">
                  <div class="col"></div>
                  
                  <div class="col align-self-center">
                      <div id="titulo_miramar">    
                      <h1 class="display-1 text-white"><strong>Miramar</strong></h1>
                      <h6 class="display-6 text-white">
                          <small class="text-muted">
                              <strong>Buenos Aires</strong>
                          </small>
                      </h6>
                      </div>
                  </div>  
  
                  <div class="col"></div>      
              </div>
      </div>
  
      <div id="instalaciones_y_amenities" class="container overflow-hidden pt-sm-3 pb-sm-3"> <!-- Instalaciones y amenities -->
          <div class="row gx-5">
              <div class="col align-self-center"> <!-- Lista de instalaciones y amenities -->
                    
                    <h1>Instalaciones y amenities</h1>
  
                    <ul class="list-unstyled custom-list">
                      
                      <li><p class="blockquote">Departamentos de 1, 2 y 3 ambientes con tv, microondas, vajilla completa y heladera con freezer. 
                        A metros de la playa, cerca de todo: a 200 metros del mar y del Parque de los Patricios.</p></li> 
                        
                      <li><p>Además, nuestras instalaciones cuentan con:</p></li>
                    
                        <ul>
                          <li>Spa, sauna seco y sauna húmedo, camilla con piedras de jade, cabina de ozono, ducha escocesa</li>
                          <li>Pileta climatizada</li>
                          <li>Gimnasio con vista al mar</li>
                          <li>Restó</li>
                          <li>Quincho y parrilla</li>
                          <li>Área de juegos con metegol</li>
                          <li>Estacionamiento cubierto</li>
                        </ul>
                       
                    </ul> 
  
                    <div class="d-grid gap-2 col-4 mx-auto">
                        <button class="btn btn-dark btn-lg" type="button"><a href="reservas_huesped.html" class="link-light">Reservar</a></button>
                    </div>
  
              </div>
  
                  <div class="col align-self-center"> <!-- Galeria imagenes HOTEL -->
                      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"> <!--  Fotografías -->
                          
                          <div class="carousel-inner">
                                  
                                  <div class="carousel-item active">
                                      <img src="imagenes/instalaciones_editadas/1_frente_costaclara.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                      <img src="imagenes/instalaciones_editadas/2_frente_anclamar.png" class="d-block w-100">
                                  </div>
                                  
                                  <div class="carousel-item">
                                      <img src="imagenes/instalaciones_editadas/3_recepcion.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/4_cama_matrimonial.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/5_cama_individual.png" class="d-block w-100">
                                  </div>
                                
                                  <div class="carousel-item">
                                      <img src="imagenes/instalaciones_editadas/6_comedor_1.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/7_comedor_2.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/8_bano_cocina.png" class="d-block w-100">
                                  </div>
                                
                                  <div class="carousel-item">
                                      <img src="imagenes/instalaciones_editadas/9_resto_barra.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/10_resto.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/11_resto_privado.png" class="d-block w-100">
                                  </div>
                              
                                  <div class="carousel-item">
                                      <img src="imagenes/instalaciones_editadas/12_gimnasio.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/13_spa_juegos.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/14_pileta.png" class="d-block w-100">
                                  </div>
  
                                  <div class="carousel-item">
                                    <img src="imagenes/instalaciones_editadas/15_patio.png" class="d-block w-100">
                                  </div>
                          </div>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Anterior</span>
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Siguiente</span>
                                  </button>
                      </div>  
                  </div>
          </div>
      </div>
  
      <div class="container pt-sm-3 pb-sm-3"> <!-- Ubicación maps -->
        
            <div class="col align-self-center row"> <!-- Para que esté centrado: self center y ROW -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d604.9506004178123!2d-57.8309883331519!3d-38.26926666248147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9585107e7dfae46b%3A0xa924413a001fddec!2sC.%2011%20837%2C%20Miramar%2C%20Provincia%20de%20Buenos%20Aires!5e0!3m2!1ses-419!2sar!4v1662787701865!5m2!1ses-419!2sar" width="900"; height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>   
  
      </div>
  
      <div class="container overflow-hidden pt-sm-3 pb-sm-3"> <!-- Galería de imagenes Miramar -->
          <div class="row gx-5">
                  <div class="col align-self-center">
                              <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel"> <!--  Fotografías -->
                                  <div class="carousel-inner">
                                  <div class="carousel-item active">
                                      <img src="imagenes/amanecer.jpg" class="d-block w-100">
                                  </div>
                                  <div class="carousel-item">
                                      <img src="imagenes/mate.jpg" class="d-block w-100">
                                  </div>
                                  <div class="carousel-item">
                                      <img src="imagenes/oca.jpg" class="d-block w-100">
                                  </div>
                                  </div>
                                  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                  </button>
                                  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                  </button>
                              </div>  
                  </div>
                  <div class="col align-self-center"> <!-- Texto publicitario imagenes -->
                              <h1>#VeranoEsMiramar</h1>
                              
                              <ul class="list-unstyled custom-list">
                                  <li><p class="blockquote">Miramar es una ciudad balnearia ubicada a tan sólo 57 kilómetros al sur de Mar del Plata.</p></li>
                                  
                                  <li><p>Un recorrido fantástico permite el acceso por la Ruta Nacional 11, que bordea la Punta Mogotes y se desarrolla entre médanos que han sido forestados.
                                  Presenta hoy impresionantes bosques de coníferas y la presencia de imponentes estancias que le dan un rasgo particular a toda la zona.</p></li>
                              
                                  <li><p>Entre sus principales atracciones se encuentran:</p></li>
                                  <ul>
                                    <li>Los balnearios: Medanos, 9 de Julio, Parquemar, Tiburón, entre otros</li>
                                    <li>El Casino</li>
                                    <li>Pibelandia</li>
                                    <li>El Teatro Municipal "Abel Santa Cruz"</li>
                                    <li>El campo de golf Cardon Miramar Links</li>
                                    <li>El bosque energético y bosque del vivero</li>
                                    <li>El recorrido del Via Crucis</li>
                                    <li>El Parque de los Patricios</li>
                                    <li>El Museo de Ciencias Naturales</li>
                                    
                                  </ul>
            
                              </ul> 
                  </div>
          </div>
      </div>
  
      <div class="container pt-sm-3 pb-sm-3"> <!-- Espacio blanco -->
      </div>
  
      <div id="footer"> <!-- Pie de página -->
        <div class="container p-3 mb-2 bg-dark text-white">
                                    <!-- El color negro de fondo completa los espacios blancos de la tabla con negro -->
        <table class="table table-dark table-borderless table-sm">
        
        <thead>
            <tr>
            <th scope="col">Dirección</th>
            <th scope="col">Teléfono</th>         
            <th scope="col">Mail</th>
            <th scope="col">Redes sociales</th>
            </tr>
        </thead>
  
        <tbody>
        
            <tr>
            <td>Calle 11 837</td>
            <td>02291-433755</td>
            <td>info@edificiocostaclara.com.ar</td>
            </tr>
        
            <tr>
            <th></th>
            <td>02291-430834</td>
            <td></td>
            <td>
                <!-- Instagram SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <a href="https://www.instagram.com/costaclaramiramar/?hl=es-la" class="link-light" target="_blank">   
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <rect x="4" y="4" width="16" height="16" rx="4"></rect>
                      <circle cx="12" cy="12" r="3"></circle>
                      <line x1="16.5" y1="7.5" x2="16.5" y2="7.501"></line>
                  </a>
                </svg>
  
            <!-- WhatsApp SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-whatsapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <a href="https://api.whatsapp.com/send?phone=541557365619&text=¡Buenos+días+%21+" class="link-light" target="_blank">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"></path>
                    <path d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1"></path>
              </a>
            </svg>
            </td>
            </tr>
  
        </tbody>
        </table>
        </div>
      </div>
  
  </body>
  
  </html>
PAGINA;

  echo $pagina; //Para mostrarla

} // Cierre función mostrar página


 
function main(){
  session_start();
  // Controlo si hay usuario logueado en el sistema
  if(isset($_SESSION['usuario'])){
    //Si hay un usuario logueado
    mostrarPagina(true); // Muestra la pág con BARRASI
 
  }else{ // Si no está logueado
    mostrarPagina(false); //Muestra la pág con BARRANO (iniciar sesión + registrarse)
  }
}

main();

?>