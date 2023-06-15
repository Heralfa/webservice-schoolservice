<?php
require_once("../models/articulo.php");
$modelo = new Articulo();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    // Agrega los casos aquí
    // Crea tus funciones en el models correpondiente
    case "insertarProducto":
        $datos = $modelo->insertarProducto($body['nombre_a'], $body['precio_a'], $body['img_a'], $body['idcat_a']);
        echo json_encode($datos);
        break;
    case "obtenerProductos":
        $datos = $modelo->obtenerProductos();
        echo json_encode($datos);
        break;
    case "obtenerProductosxCategoria":
        $datos = $modelo->obtenerProductosxCategoria($body['idcat_a']);
        echo json_encode($datos);
        break;
}
