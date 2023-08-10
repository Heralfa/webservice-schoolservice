<?php
require_once("../models/usuario.php");
$modelos = new Usuario();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    case "login";
        $datos = $modelos->login($body['correo'], $body['pass']);
        echo json_encode($datos);
        break;

    case "agregarUsuario";
        $datos = $modelos->agregarUsuario($body['nombres'],$body['apellidoP'],$body['apellidoM'],$body['rfc'],$body['correo'],$body['pass'],$body['carrera']);
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

    case "editarUsuario";
        $datos = $modelos->editarUsuario($body['idUsuario'],$body['nombres'],$body['apellidoP'],$body['apellidoM'],$body['rfc'],$body['correo'],$body['pass'],$body['carrera']);
        echo json_encode($datos);
        break;

}
