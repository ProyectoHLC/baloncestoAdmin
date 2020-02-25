<!DOCTYPE html>
<html>
  <head>
  <?php
	include 'functions.php';
	?>
  <title>Liga Baloncesto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>" />
	<script src="/js/functions.js?v=<?php echo time(); ?>"></script>

    <link href="css/stats.css" rel="stylesheet">

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
                    <li ><a href="principal.php"><i class="glyphicon glyphicon-home"></i> Datos Liga</a></li>
                    <li><a href="equipos.php"><i class="glyphicon glyphicon-calendar"></i> Equipos</a></li>
                    <li class="current"><a href="resultados.php"><i class="glyphicon glyphicon-stats"></i> Resultados</a></li>
                </ul>
             </div>
		  </div>
		  <div class="col-md-10">
		  	<div class="row">
		  		<div class="col-md-6">
		  			<div class="content-box-large">
					
						  <?php
							  $resultado = $database->select("resultados","*",true);
							  $count = $database->count("resultados","*",true);
							  if(($count)==0){
								echo '<div class="panel-heading">
								<div class="panel-title">Resultados</div>
							</div>
							  <div class="panel-body">
							  <h1>No hay resultados</h1>
							  <form action="resultados.php" method="post">
								<p>Equipo 1: <input type="text" name="equipo1" /></p>
								<p>Equipo 2: <input type="text" name="equipo2" /></p>
								<p>Resultado 1: <input type="text" name="result1" /></p>
								<p>Resultado 2: <input type="text" name="result2" /></p>
								<p>Fecha: <input type="text" name="fecha" /></p>
								<p><input type="submit" name="add" value="Añadir" /></p>
							   </form>';
							   if (isset($_POST['add'])){
								if (isset($_POST['equipo1']) && isset($_POST['equipo2']) && isset($_POST['result1'])&& isset($_POST['result2'])&& isset($_POST['fecha'])) {
									$equipo1 = $_POST['equipo1'];
									$equipo2 = $_POST['equipo2'];
									$result1 = $_POST['result1'];
									$result2 = $_POST['result2'];
									$fecha = $_POST['fecha'];
							
									$insertar = $database->insert("resultados",[
										"cod_equipo1" => $equipo1,
										"cod_equipo2" => $equipo2,
										"result_equipo1" => $result1,
										"result_equipo2" => $result2,
										"fecha" => $fecha
									]);									
									// Comprobando errores
									if ($insertar == 0) {
										var_dump($database->error());
									} else {
										header('Location: resultados.php');
									}
								}
							}
							  }else{
								echo '
								<div class="panel-heading">
							<div class="panel-title">Resultados</div>
							
							<div class="panel-options">
								<a href="editLiga.php" data-rel="collapse"><i class="glyphicon glyphicon-edit"></i></a>
							</div>
						</div>
		  				<div class="panel-body">
								<table>
								<tr> 
								<th>Equipo 1</th>
								<th>Equipo 2</th>
								<th>Resultado 1</th>
								<th>Resultado 2</th>
								<th>Fecha</th>
								</tr>
								<tr> ';
								foreach( $resultado as $result){

									echo '<tr>
									<td>';
									echo $result['cod_equipo1'];
									echo '</td><td>';
									echo $result['cod_equipo2'];
									echo '</td><td>';
									echo $result['result_equipo1'];
									echo '</td><td>';
									echo $result['result_equipo2'];
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