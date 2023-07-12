<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Actividades extends Conexion {
    
    public function agregarTarea( $titulo, $descripcion,$organizacion, $horasActividad, $vacantes,$horaInicio,$fecha,$lugar) {
        $link = parent::connect();
        parent::set_names();
        $sql = "INSERT INTO `actividades`( `titulo`, `descripcion`, `organizacion`, `horasActividad`, `vacantes`, `horaInicio`, `fecha`, `lugar`) VALUES (?,?,?,?,?,?,?,?)";
        $sql = $link->prepare($sql);
        $sql->bindValue(1, $titulo);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $organizacion);
        $sql->bindValue(4, $horasActividad);
        $sql->bindValue(5, $vacantes);
        $sql->bindValue(6, $horaInicio);
        $sql->bindValue(7, $fecha);
        $sql->bindValue(8, $lugar);
    
        $result['status'] = $sql->execute();
        return $result;
    }

    function get_tareas() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM actividades;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }


    function get_Actividad_x_id($idActividad) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM actividades WHERE idActividad = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idActividad);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
   

}
