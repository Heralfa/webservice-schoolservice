<?php
require_once("../models/actividades.php");
$modelos = new Actividades();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    case "insertarTarea":
        $datos = $modelos->agregarTarea($body['titulo'], $body['descripcion'], $body['organizacion'],
        $body['horasActividad'], $body['vacantes'], $body['horaInicio'], $body['fecha'], $body['lugar']
        );
        echo json_encode($datos);
        break;
    case "traerActividades";
        $datos = $modelos->get_tareas();
        echo json_encode($datos);
        break;
    case "traerActividadxid";
        $datos = $modelos->get_Actividad_x_id($body['idActividad']);
        echo json_encode($datos);
        break;
    case "editarActividad";
        $datos = $modelos->editarActividad($body['idActividad'],$body['titulo'], $body['descripcion'],$body['organizacion'],
        $body['horasActividad'],$body['vacantes'],$body['horaInicio'],$body['fecha'],$body['lugar']);
        echo json_encode($datos);
        break;
}
