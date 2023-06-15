<?php
require_once("../models/usuario.php");
$modelos = new Usuario();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    case "agregarSaldo":
        $datos = $modelos->agregarSaldo($body['id_u'], $body['saldo_u']);
        echo json_encode($datos);
        break;

    // Lo unico que hice..........
    case "login";
        $datos = $modelos->login($body['usuario_u'], $body['pass']);
        echo json_encode($datos);
        break;

    case "agregarUsuario";
        $datos = $modelos->agregarUsuario($body['usuario_u'], $body['nombres_u'], $body['apellidos_u'], $body['email_u'], $body['pass']);
        echo json_encode($datos);
        break;
    case "traerUsuario";
        $datos = $modelos->get_usuario();
        echo json_encode($datos);
        break;
    case "traerUsuarioxid";
        $datos = $modelos->get_usuario_x_id($body['id_u']);
        echo json_encode($datos);
        break;
}
