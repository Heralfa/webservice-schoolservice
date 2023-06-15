<?php
require_once("../models/categoria.php");
$modelo = new Categoria();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    // Agrega los casos aquí
    // Crea tus funciones en el models correpondiente
    case "agregarCategoria":
        $datos = $modelo->agregarCategoria($body['nombre_c'], $body['com_c'], $body['banner_c']);
        echo json_encode($datos);
        break;
    case "traerCategorias":
        $datos = $modelo->traerCategorias();
        echo json_encode($datos);
        break;
}
