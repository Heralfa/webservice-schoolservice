<?php
require_once("../models/actividades.php");
$modelos = new Actividades();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["option"]) {

    case "insertarTarea":
        $datos = $modelos->insertarTarea($body['titulo'], $body['descripcion'], $body['organizacion'],
        $body['horasActividad'], $body['vacantes'], $body['horaInicio'], $body['fecha'], $body['lugar']
        );
        echo json_encode($datos);
        break;

    case "traerActividades";
        $datos = $modelos->get_tareas();
        echo json_encode($datos);
        break;

    case "traerActividadxid";
        $datos = $modelos->get_actividad_x_id($body['idActividad']);
        echo json_encode($datos);
        break;
    case "editarActividad";
        $datos = $modelos->editarActividad($body['idActividad'],$body['titulo'], $body['descripcion'],$body['organizacion'],
        $body['horasActividad'],$body['vacantes'],$body['horaInicio'],$body['fecha'],$body['lugar']);
        echo json_encode($datos);
        break;

    case "traerActividesProceso";
        $datos = $modelos->getActividadesProceso();
        echo json_encode($datos);
        break;
        
    case "traerActividesPendientes";
        $datos = $modelos->getActividadesPendientes();
        echo json_encode($datos);
        break;
    case "traerActividesTerminada";
        $datos = $modelos->getActividadesTerminada();
        echo json_encode($datos);
        break;
}
