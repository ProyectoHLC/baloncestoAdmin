<?php
//Establecemos la conexión con la base de datos.
//Crea una instancia de la clase Medoo. (Se crea un objeto)

require 'Medoo.php';

use Medoo\Medoo;

$database = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'baloncesto',
    'server' => 'localhost',
    'username' => 'root',
    'password' => ''
]);

session_start();

if ($_SESSION['username'] == null) {
    header("Location: index.html", true);
}

function headerProfileMenu()
{
    $username = $_SESSION['username'];
    echo "<div class=\"col-md-2\">
	              <div class=\"navbar navbar-inverse\" role=\"banner\">
	                  <nav class=\"collapse navbar-collapse bs-navbar-collapse navbar-right\" role=\"navigation\">
	                    <ul class=\"nav navbar-nav\">
	                      <li class=\"dropdown\">
	                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">$username <b class=\"caret\"></b></a>
	                        <ul class=\"dropdown-menu animated fadeInUp\">
	                          <!-- No es necesario por ahora <li><a href=\"profile.html\">Profile</a></li>-->
	                          <li><a href=\"logout.php\">Logout</a></li>
	                        </ul>
	                      </li>
	                    </ul>
	                  </nav>
	              </div>
	           </div>";
}