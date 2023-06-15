<?php
require_once("../models/comentario.php");
$modelo = new Comentario();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    // Agrega los casos aquí
    // Crea tus funciones en el models correpondiente
    case "insertarComentario":
        $datos = $modelo->insertarComentario($body['com'], $body['idu_com'], $body['ida_com']);
        echo json_encode($datos);
        break;
    case "obtenerComentario":
        $datos = $modelo->obtenerComentario($body['ida_com']);
        echo json_encode($datos);
        break;
    case "obtenerComentarios":
        $datos = $modelo->obtenerComentarios();
        echo json_encode($datos);
        break;
    case "comentariosXCategoria":
        $datos = $modelo->comentariosXCategoria($body['id_c']);
        echo json_encode($datos);
        break;
    case "comentariosXNft":
        $datos = $modelo->comentariosXNft($body['id_a']);
        echo json_encode($datos);
        break;
}
