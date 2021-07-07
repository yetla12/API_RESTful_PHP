<?php

require_once "controladores/rutas.controlador.php";
require_once "controladores/instructor.controlador.php";

require_once "modelos/instructor.modelo.php";

$rutas = new controladorRutas();
$rutas -> index();