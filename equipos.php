<!DOCTYPE html>
<html>
  <head>
  <?php
    include 'functions.php';

	//Establecemos la conexión con la base de datos.
	//Crea una instancia de la clase Medoo. (Se crea un objeto)

	?>
  <title>Liga Baloncesto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/fullcalendar/fullcalendar.css" rel="stylesheet" media="screen">
    <!-- styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>" />
	<script src="/js/functions.js?v=<?php echo time(); ?>"></script>

    <link href="css/calendar.css" rel="stylesheet">

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
                <?php
                headerProfileMenu();
                ?>
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
                    <li class="current"><a href="equipos.php"><i class="glyphicon glyphicon-calendar"></i> Equipos</a></li>
                    <li><a href="resultados.php"><i class="glyphicon glyphicon-stats"></i> Resultados</a></li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-large">
					
						  <?php
							  $resultado = $database->select("equipos","*",true);
							  $count = $database->count("equipos","*",true);
							  if(($count)==0){
								echo '<div class="panel-heading">
								<div class="panel-title">Datos Equipos</div>
							</div>
							  <div class="panel-body">
							  <form action="principal.php" method="post">
								<p>Nombre: <input type="text" name="name" /></p>
								<p>Año: <input type="password" name="year" /></p>
								<p>Descripcion: <input type="password" name="description" /></p>
								<p><input type="submit" value="Guardar" /></p>
							   </form>';
							  }else{
								echo '
								<div class="panel-heading">
							<div class="panel-title">Datos Liga</div>
							
							<div class="panel-options">
								<a href="editLiga.php" data-rel="collapse"><i class="glyphicon glyphicon-edit"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
								<table>
								<tr> 
								<th>cod_equipo</th>
								<th>cod_liga</th>
								<th>nombre</th>
								<th>ciudad</th>
								<th>num_social</th>
								<th>fecha</th>
								</tr>
								<tr> ';
								foreach( $resultado as $result){

									echo '<tr>
									<td>';
									echo $result['cod_equipo'];
									echo '</td><td>';
									echo $result['cod_liga'];
                                    echo '</td><td>';
                                    echo $result['nombre'];
                                    echo '</td><td>';
                                    echo $result['ciudad'];
                                    echo '</td><td>';
                                    echo $result['num_social'];
                                    echo '</td><td>';
                                    echo $result['fecha'];
									echo '</td>';
									echo '</tr>';
								   }
								   echo '</table>';
								   
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
               Copyright 2020
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