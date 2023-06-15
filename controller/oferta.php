<?php
require_once("../models/oferta.php");
$modelo = new Oferta();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    // Agrega los casos aquí
    // Crea tus funciones en el models correpondiente
    case "insertarOferta":
        $datos = $modelo->insertarOferta($body['desc_o'], $body['fechain_o'], $body['fechafin_o'], $body['banner_o']);
        echo json_encode($datos);
        break;
    case "obtenerOfertas":
        $datos = $modelo->obtenerOfertas();
        echo json_encode($datos);
        break;
}
