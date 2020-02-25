<!DOCTYPE html>
<html>
  <head>
  <?php
	require 'Medoo.php';
	use Medoo\Medoo;

	//Establecemos la conexión con la base de datos.
	//Crea una instancia de la clase Medoo. (Se crea un objeto)
	$database = new Medoo([
		'database_type' => 'mysql',
		'database_name' => 'baloncesto',
		'server' => 'localhost',
		'username' => 'root',
		'password' => ''
	]);
	?>
    <title>Liga Baloncesto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>" />
	<script src="/js/functions.js?v=<?php echo time(); ?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="header">
	     <div class="container">
	        <div class="row">
	           <div class="col-md-5">
	              <!-- Logo -->
	              <div class="logo">
	                 <h1><a href="principal.php">Liga Baloncesto</a></h1>
	              </div>
	           </div>
	           <div class="col-md-5">
	              <div class="row">
	                <div class="col-lg-12">
	                  <div class="input-group form">
	                       </span>
	                  </div>
	                </div>
	              </div>
	           </div>
	           <div class="col-md-2">
	              <div class="navbar navbar-inverse" role="banner">
	                  <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
	                    <ul class="nav navbar-nav">
	                      <li class="dropdown">
	                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
	                        <ul class="dropdown-menu animated fadeInUp">
	                          <li><a href="profile.html">Profile</a></li>
	                          <li><a href="index.html">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>
	        </div>
	     </div>
	</div>

    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <li><a href="principal.php"><i class="glyphicon glyphicon-home"></i> Datos Liga</a></li>
                    <li><a href="equipos.php"><i class="glyphicon glyphicon-calendar"></i> Equipos</a></li>
                    <li><a href="resultados.php"><i class="glyphicon glyphicon-stats"></i> Resultados</a></li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-large">
                    <div class="panel-heading">
                            <div class="panel-title">Añadir resultado</div>
							    </div>
							    <div class="panel-body">
                  <?php
                 
                  
            
                  
                  echo '<form action="addResultados.php" method="post">
                    <label>
                        Cod Equipo 1 <input name="equipo1" required   type="text" />
                    </label><br>
                    <label>
                    Cod Equipo 2 <input name="equipo2" required type="text" />
                    </label><br>
                    <label>
                    Resultado 1 <input name="resultEquipo1" required type="text"/>
                    </label><br>
                    <label>
                    Resultado 1 <input name="resultEquipo2"  required type="text"/>
                    </label><br>
                    <label>
                      Fecha <input name="fecha" required type="text"/>
                    </label><br>
                    <input name="add" class="boton" type="submit" value="Añadir"/>
                    <h3><a href="resultados.php">Volver a datos de resultados</a></h3>
                  </form>';
                  
                  ?>
<?php
//Capturamos los nuevos datos introducidos por el usuario
if (isset($_POST['add'])){
        $equipo1 = $_POST['equipo1'];
        $equipo2 = $_POST['equipo2'];
        $result_equipo1 = $_POST['resultEquipo1'];
        $result_equipo2 = $_POST['resultEquipo2'];
        $fecha = $_POST['fecha'];


        $actualizacion = $database->insert("resultados", array("cod_equipo1" => $equipo1,"cod_equipo2" => $equipo2,"result_equipo1" => $result_equipo1, "result_equipo2" => $result_equipo2, "fecha" => $fecha));
        $result = $actualizacion->fetch();
        // Comprobando errores
        if ($result) {
            var_dump($database->error());
        } else {
            header('Location: resultados.php');
        }
}

						  ?>
							
		  				</div>
		  			</div>
		  		</div>

		  	</div>
		</div>
    </div>

    <footer>
         <div class="container">
         
            <div class="copy text-center">
               Copyright 2020 <a href='#'>Website</a>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>