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

    case "editarEstado";
        $datos = $modelos->editarEstado($body['idUsuarioActividad'],$body['estado']);
        echo json_encode($datos);
        break;

        // ------------------------------------------------------------------- Alumnos -------------------------------------------------

    case "traerActividadProcesoxid";
        $datos = $modelos->getActividadesProcesoxid($body['idUsuario']);
        echo json_encode($datos);
        break;

    case "traerActividadPendientesxid";
        $datos = $modelos->getActividadesPendientesxid($body['idUsuario']);
        echo json_encode($datos);
        break;

    case "traerActividadTerminadaxid";
        $datos = $modelos->getActividadesTerminadaxid($body['idUsuario']);
        echo json_encode($datos);
        break;

    case "comprobar";
        $datos = $modelos->comprobar($body['idUsuario'],$body['idActividad']);
    case "subirEvidencias";
        $datos = $modelos->subirEvidencia($body['idUsuarioActividad'],$body['evidencia'],$body['estado']);
        echo json_encode($datos);
        break;

    case "postularse";
        $datos = $modelos->postularte($body['idUsuario'],$body['idActividad']);
        echo json_encode($datos);
        break;

    case "editarVacantes";
        $datos = $modelos->editarvacantes($body['idActividad'],$body['vacantes']);
        echo json_encode($datos);
        break;
}
