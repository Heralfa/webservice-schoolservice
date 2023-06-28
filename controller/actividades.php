<?php
require_once("../models/actividades.php");
$modelos = new Actividades();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    case "insertarTarea":
        $datos = $modelos->insertarTarea($body['titulo'], $body['descripcion'], $body['organizacion'],
        $body['horasActividad'], $body['vacantes'], $body['horasInicio'], $body['fecha'], $body['lugar']
        ,$body['estado']);
        echo json_encode($datos);
        break;
    // Lo unico que hice..........
    case "login";
        $datos = $modelos->login($body['correo'], $body['pass']);
        echo json_encode($datos);
        break;

    case "agregarUsuario";
        $datos = $modelos->agregarUsuario($body['nombres'],$body['apellidoM'],$body['apellidoP'],$body['rfc'],$body['correo'],$body['pass'],$body['carrera']);
        echo json_encode($datos);
        break;
    case "traerUsuario";
        $datos = $modelos->get_usuario();
        echo json_encode($datos);
        break;
    case "traerUsuarioxid";
        $datos = $modelos->get_usuario_x_id($body['idUsuario']);
        echo json_encode($datos);
        break;
}
