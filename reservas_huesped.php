<?php
// CONEXIÓN SACADA DE REGISTRO.PHP

$db_host = "localhost";
$db_nombre = "hotel";
$db_usuario = "root";
$db_contra = "root"; 

$conexion = mysqli_connect($db_host, $db_usuario, $db_contra, $db_nombre); 

mysqli_set_charset($conexion, "utf8");

mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la base de datos");


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
    $pagina=<<<RESERVAS

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> <!-- Para que sea responsive, lo necesita bootstrap -->
    
        <!-- Este código es para relacionar bootstrap -->
        <title>Hotel Costa Clara - Reservas huesped</title>
    
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
                                      <a class="nav-link" href="index.html">Home</a>
                                    </li>
    
                                    <li class="nav-item">
                                      <a class="nav-link active" href="#reserva">Reservar</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                      <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#precios">Precios</a>
                                    </li>
    
                                    <li class="nav-item">
                                      <a class="nav-link" href="#footer">Contacto</a>
                                    </li>
                            </ul>
                      </div>
    
                      <div class="d-grid gap-2 col-3"> <!-- Derecha: dropdown sesión iniciada -->
    
                        <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Bienvenid@ Nombre Usuario
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
    
                  </div>
            </nav>
        </div>
      </div>
    
      <div class="modal" id="precios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal: precios -->
        <div class="modal-dialog modal-dialog-centered">
          
          <div class="modal-content">
            
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Precios</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
    
              <div class="modal-body">
                    <p>Los siguientes precios son estimaciones y pueden variar según la temporada y los índices de inflación. Para mayor precisión, envíenos su consulta. </p>
                  
                    <table class="table table-borderless">
    
                        <tbody>
                          <tr>
                            <th scope="row">2 camas individuales</th>
                            <td>$...</td>
                          </tr>
    
                          <tr>
                            <th scope="row">4 camas indivuales</th>
                            <td>$...</td>
                          </tr>
    
                          <tr>
                            <th scope="row">1 cama matrimonial</th>
                            <td colspan="2">$...</td>
                          </tr>
    
                          <tr>
                            <th scope="row">2 camas matrimoniales</th>
                            <td colspan="2">$...</td>
                          </tr>
    
                          <tr>
                            <th scope="row">1 individual, 1 matrimonial</th>
                            <td colspan="2">$...</td>
                          </tr>
    
                          <tr>
                            <th scope="row">2 individuales, 1 matrimonial</th>
                            <td colspan="2">$...</td>
                          </tr>
    
                          <tr> <!-- Espacio blanco antes de la barra divisora -->
                            <th scope="row" colspan="2">&nbsp</th>
                          </tr>
    
                          <tr> <!-- Barra divisoria -->
                            <th class="table-group-divider" scope="row" colspan="2"></th>
                          </tr>
    
                          <tr>
                            <th scope="row">Con cocina</th>
                            <td colspan="2">Extra de $...</td>
                          </tr>
    
                          <tr>
                            <th scope="row">Con jacuzzi</th>
                            <td colspan="2">Extra de $...</td>
                          </tr>
    
                        </tbody>
                    </table>
              </div>
    
          </div>
        </div>
    
      </div>
    
      <div class="modal" id="perfil_huesped" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal: perfil usuario huesped -->
        <div class="modal-dialog modal-dialog-centered">
          
          <div class="modal-content">
            
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Mi perfil</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
    
              <div class="modal-body">
                  
                    <table class="table table-borderless">
    
                        <tbody>
                          <tr>
                            <th scope="row">Nombre y apellido</th>
                            <td>Camila Páez</td>
                          </tr>
    
                          <tr>
                            <th scope="row">Documento</th>
                            <td>DNI 12.345.678</td>
                          </tr>
    
                          <tr>
                            <th scope="row">Teléfono</th>
                            <td colspan="2">+54 11 23456789</td>
                          </tr>
    
                          <tr>
                            <th scope="row">Mail</th>
                            <td colspan="2">huesped@mail.com</td>
                          </tr>
    
                        </tbody>
                    </table>
    
                    <p>Para modificar algún dato, contactate con nosotros.</p>
              </div>
    
          </div>
        </div>
    
      </div>
    
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
    
        <div class="container pt-sm-3 pb-sm-3 overflow-hidden gy-5"> <!-- Reserva -->
          
              <h1 id="reserva">Reserva</h1>
              <p class="blockquote">Los items con un asterisco (*) son obligatorios.</p>
    
              <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->
    
              <div class="row overflow-hidden gx-5"> <!-- Dos columnas -->

                    <div class="col col-sm-5 align-self-center"> <!-- Menú izquierdo -->
                    
                        <form method="post" action="reserva_dispo.php">
                            <div class="row overflow-hidden gy-8">
                                    <h5>Edificio</h5>
                                    <p>Nuestras instalaciones se encuentran en 2 edificios enfrentados, separados solo por una calle.</p>
                                    <p style="display:inline-block">
                                    <select id="edificio" type="button" class="btn btn-secondary dropdown-toggle btn-dark" name="edificio">
                                        <option value="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="3" y1="21" x2="21" y2="21"></line>
                                            <line x1="9" y1="8" x2="10" y2="8"></line>
                                            <line x1="9" y1="12" x2="10" y2="12"></line>
                                            <line x1="9" y1="16" x2="10" y2="16"></line>
                                            <line x1="14" y1="8" x2="15" y2="8"></line>
                                            <line x1="14" y1="12" x2="15" y2="12"></line>
                                            <line x1="14" y1="16" x2="15" y2="16"></line>
                                            <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16"></path>
                                        </svg>
                                        &nbsp Seleccionar <!-- &nbsp para dejar un espacio -->
                                        </option>
                                        <option value="">Costa Clara</option>
                                        <option value="">Anclamar</option>
                                    </select>
                                    </p>
                            </div>
            
                            <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->
                            
                            <div class="row overflow-hidden gy-8">
                                    <h5>Fecha*</h5>
                                    <p style="display:inline-block">
                                    <label for="date">Desde &nbsp</label>  <!-- &nbsp para dejar un espacio -->
                                    <input type="date" id="date" name="fecha_desde">
                                    <label for="date">&nbsp hasta &nbsp</label> <!-- &nbsp para dejar un espacio -->
                                    <input type="date" id="date" name="fecha_hasta">
                                    </p>
                            </div>
            
                            <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->
            
                            <div class="row overflow-hidden gy-8">
                                    <h5>Cantidad de camas*</h5>
            
                                    <p style="display:inline-block">
                                    Individuales &nbsp <!-- &nbsp para dejar un espacio -->
                                        <select id="camas" type="button" class="btn btn-secondary dropdown-toggle btn-dark" name="cindiv">
                                        <option value="" style="display:none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                            &nbsp Seleccionar <!-- &nbsp para dejar un espacio -->
                                        </option> 
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        </select>
                                    </p>
            
                                    <p style="display:inline-block">
                                    Matrimoniales &nbsp <!-- &nbsp para dejar un espacio -->
                                    <select id="camas" type="button" class="btn btn-secondary dropdown-toggle btn-dark" name="cmatri">
                                        <option value="" style="display:none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                            </svg>
                                            Seleccionar
                                        </option> 
                                        <option value="">1</option>
                                        <option value="">2</option>
                                    </select>
                                    </p>
                            </div>
                            
                            <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->
            
                            <div class="row overflow-hidden gy-8">
                                    <h5>Prestaciones</h5>
            
                                    <label>
                                    <input type="checkbox" value="cocina" name="cocina">
                                    &nbsp Con cocina <!-- &nbsp para dejar un espacio -->
                                    </label>
                                                                    
                                    <label>
                                    <input type="checkbox" value="jacuzzi" name="jacuzzi">
                                    &nbsp Con jacuzzi <!-- &nbsp para dejar un espacio -->
                                    </label>
                            </div>

                            <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->

                            <div class="row overflow-hidden gy-8">
                                <input type="submit" name="disponibilidad" value="Ver disponibilidad" class="btn btn-secondary">
                            </div>

                        </form>
                    </div> <!-- Cierre columna menú izquierdo-->

                    <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->
                
                    <div class="col col-sm-7 align-self-center"> <!-- Menú derecho -->
                      
                      <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist"> <!-- Barra de navegación de la TAB -->
                          <button class="nav-link active link-light bg-dark" id="nav-costaclara-tab" data-bs-toggle="tab" data-bs-target="#nav-costaclara" type="button" role="tab" aria-controls="nav-costaclara" aria-selected="true">Costa Clara</button>
                          <button class="nav-link link-light bg-dark" id="nav-anclamar-tab" data-bs-toggle="tab" data-bs-target="#nav-anclamar" type="button" role="tab" aria-controls="nav-anclamar" aria-selected="false">Anclamar</button>
                        </div>
                      </nav>
    
                        <div id="tabs">
                          <div class="row align-items-start">
                            <div class="tab-pane fade in active" id="nav-costaclara" role="tabpanel" aria-labelledby="nav-costaclara-tab" tabindex="0"> <!-- Contenido TAB Costa Clara-->
                                  <div class="card text-center rounded-0 border-dark">
                                    
                                    <div class="card-body"> 
                                                <div class="row g-0 align-items-start"> <!-- Imagen + hab disponibles -->
                                                  
                                                    <div class="col-md-4"> <!-- IMAGEN -->
                                                      <img src="imagenes/instalaciones_editadas/1_frente_costaclara_angosto.png" class="img-fluid">
                                                    </div>
    
                                                    <div class="col-md-8"> <!-- Columna de HABITACIONES DISPONIBLES -->
                                                          <div class="card-body">
                                                                <h5 class="card-title">Habitaciones disponibles</h5>
                                                                <h6>&nbsp</h6> <!-- &nbsp para dejar un espacio -->
                                                                
                                                                <div class="card mb-3 text-bg-dark" style="max-width: 720px;"> <!-- Tarjeta piso 3 -->
                                                                    <div class="row g-0">
                                                                      
                                                                        <div class="col-md-4 align-self-center">
                                                                          <h6 class="card-title">Piso 3</h6>
                                                                        </div>
                                                  
                                                                        <div class="col-md-8">
                                                                          <div class="card-body">
                                                                            <button type="button" class="btn btn-outline-light disabled">3A</button>
                                                                            <button type="button" class="btn btn-success active">3B</button>
                                                                            <button type="button" class="btn btn-success active">3C</button>
                                                                            <button type="button" class="btn btn-outline-light disabled">3D</button>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                </div>
                                                
                                                                <div class="card mb-3 text-bg-dark" style="max-width: 720px;"> <!-- Tarjeta piso 2 -->
                                                                    <div class="row g-0">
                                                                      
                                                                        <div class="col-md-4 align-self-center">
                                                                          <h6 class="card-title">Piso 2</h6>
                                                                        </div>
                                                  
                                                                        <div class="col-md-8">
                                                                          <div class="card-body">
                                                                            <button type="button" class="btn btn-outline-light disabled">2A</button>
                                                                            <button type="button" class="btn btn-success">2B</button>
                                                                            <button type="button" class="btn btn-outline-light disabled">2C</button>
                                                                            <button type="button" class="btn btn-success">2D</button>
                                                                          </div>
                                                                      </div>
                                                                    </div>
                                                                </div>
                                              
                                                                <div class="card mb-3 text-bg-dark" style="max-width: 720px;"> <!-- Tarjeta piso 1 -->
                                                                    <div class="row g-0">
                                                                      
                                                                        <div class="col-md-4 align-self-center">
                                                                          <h6 class="card-title">Piso 1</h6>
                                                                        </div>
                                                  
                                                                        <div class="col-md-8">
                                                                          <div class="card-body">
                                                                            <button type="button" class="btn btn-outline-light disabled">1A</button>
                                                                            <button type="button" class="btn btn-success">1B</button>
                                                                            <button type="button" class="btn btn-success">1C</button>
                                                                            <button type="button" class="btn btn-outline-light disabled">1D</button>
                                                                          </div>
                                                                      </div>
                                                                  </div>
                                                                </div>
    
                                                          </div> <!-- Cierre body card -->
                                                    </div> <!-- Cierre columna habitaciones -->
    
                                                </div> <!-- Cierre fila -->
    
                                    </div> <!-- Cierre body card Costa Clara -->
                                  </div> <!-- Cierre card -->
                            </div> <!-- Cierre div TAB Costa Clara-->
    
                            <div class="tab-pane fade" id="nav-anclamar" role="tabpanel" aria-labelledby="nav-anclamar-tab" tabindex="0"> <!-- Contenido TAB Anclamar-->
                              <div class="card text-center rounded-0 border-dark">
                                    
                                <div class="card-body"> 
                                          
                                            <div class="row g-0 align-items-start"> <!-- Imagen + hab disponibles -->
                                              
                                                <div class="col-md-4"> <!-- IMAGEN -->
                                                  <img src="imagenes/instalaciones_editadas/1_frente_costaclara_angosto.png" class="img-fluid">
                                                </div>
    
                                                <div class="col-md-8"> <!-- Columna de HABITACIONES DISPONIBLES -->
                                                      <div class="card-body">
                                                            <h5 class="card-title">Habitaciones disponibles</h5>
                                                            <h6>&nbsp</h6> <!-- &nbsp para dejar un espacio -->
                                                            
                                                            <div class="card mb-3 text-bg-dark" style="max-width: 700px;"> <!-- Tarjeta piso 3 -->
                                                                <div class="row g-0">
                                                                  
                                                                    <div class="col-md-4 align-self-center">
                                                                      <h6 class="card-title">Piso 3</h6>
                                                                    </div>
                                              
                                                                    <div class="col-md-8">
                                                                      <div class="card-body">
                                                                        <button type="button" class="btn btn-outline-light disabled">3A</button>
                                                                        <button type="button" class="btn btn-success active">3B</button>
                                                                        <button type="button" class="btn btn-success active">3C</button>
                                                                        <button type="button" class="btn btn-outline-light disabled">3D</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                            </div>
                                            
                                                            <div class="card mb-3 text-bg-dark" style="max-width: 700px;"> <!-- Tarjeta piso 2 -->
                                                                <div class="row g-0">
                                                                  
                                                                    <div class="col-md-4 align-self-center">
                                                                      <h6 class="card-title">Piso 2</h6>
                                                                    </div>
                                              
                                                                    <div class="col-md-8">
                                                                      <div class="card-body">
                                                                        <button type="button" class="btn btn-outline-light disabled">2A</button>
                                                                        <button type="button" class="btn btn-success">2B</button>
                                                                        <button type="button" class="btn btn-outline-light disabled">2C</button>
                                                                        <button type="button" class="btn btn-success">2D</button>
                                                                      </div>
                                                                  </div>
                                                                </div>
                                                            </div>
                                          
                                                            <div class="card mb-3 text-bg-dark" style="max-width: 700px;"> <!-- Tarjeta piso 1 -->
                                                                <div class="row g-0">
                                                                  
                                                                    <div class="col-md-4 align-self-center">
                                                                      <h6 class="card-title">Piso 1</h6>
                                                                    </div>
                                              
                                                                    <div class="col-md-8">
                                                                      <div class="card-body">
                                                                        <button type="button" class="btn btn-outline-light disabled">1A</button>
                                                                        <button type="button" class="btn btn-success">1B</button>
                                                                        <button type="button" class="btn btn-success">1C</button>
                                                                        <button type="button" class="btn btn-outline-light disabled">1D</button>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                            </div>
    
                                                      </div> <!-- Cierre body card -->
                                                </div> <!-- Cierre columna habitaciones -->
                                            </div> <!-- Cierre fila imagen + hab disponibles -->
    
                          
                                  </div> <!-- Cierre body card Anclamar -->
                              </div> <!-- Cierre card Anclamar -->
                            </div> <!-- Cierre TAB Anclamar -->
                          </div>
                        </div>
                      
                    </div> <!-- Cierre columna menú derecho-->

              </div> <!-- Cierre div 2 columnas -->

        </div> <!-- Cierre Reserva -->
    
        <div class="modal" id="boton_confirmar_reserva" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> <!-- Modal copiado: https://www.codeply.com/p/qikoyVgKHL -->
          <div class="modal-dialog modal-dialog-centered">
            
            <div class="modal-content">
              
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Confirmación de la reserva</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
    
                <div class="modal-body">
                      <p class="blockquote">Por favor, confirme los datos de su reserva:</p>
                    
                      <table class="table table-borderless">
    
                          <tbody>
                            <tr>
                              <th scope="row">Edificio</th>
                              <td>Costa Clara</td>
                            </tr>
    
                            <tr>
                              <th scope="row">Habitación</th>
                              <td>3B, 3C</td>
                            </tr>
    
                            <tr>
                              <th scope="row">Fecha</th>
                              <td colspan="2">Desde 16/09/2022 hasta 20/09/2022</td>
                            </tr>
    
                            <tr>
                              <th scope="row">Camas</th>
                              <td colspan="2">1 matrimonial, 2 individuales</td>
                            </tr>
    
                            <tr>
                              <th scope="row">Prestaciones</th>
                              <td colspan="2">Con cocina</td>
                            </tr>
    
                            <tr>
                              <th scope="row">Precio</th>
                              <td colspan="2">$8500</td>
                            </tr>
                          </tbody>
                      </table>
                </div>
    
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="button" class="btn btn-primary btn-success">Confirmar reserva</button>
                </div>
    
            </div>
          </div>
    
        </div>
     
        <div class="row overflow-hidden gy-8"> <!-- Botón COPIADO Y MODIFICADO de reserva https://www.codeply.com/p/qikoyVgKHL -->
          <div class="d-grid gap-2 col-4 mx-auto">
              <button type="button" class="btn btn-primary btn-success btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-browser-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <rect x="4" y="4" width="16" height="16" rx="1"></rect>
                  <path d="M4 8h16"></path>
                  <path d="M8 4v4"></path>
                  <path d="M9.5 14.5l1.5 1.5l3 -3"></path>
                </svg>
                <a href="#" data-bs-toggle="modal" data-bs-target="#boton_confirmar_reserva" class="link-light">Reservar</a>
              </button>
          </div>
        </div>
    
        <div class="row overflow-hidden gy-8"><h3>&nbsp</h3></div> <!-- DIVISOR &nbsp para dejar un espacio -->
    
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

RESERVAS;

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


?>