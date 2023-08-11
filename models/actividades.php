<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Actividades extends Conexion {
    
    function insertarTarea($titulo, $descripcion, $organizacion, $horaActividad,$vacantes,$horaInicio,
    $fecha,$lugar) {
        $db = parent::connect();
        parent::set_names();
        $sql = "INSERT INTO `actividades`( `titulo`, `descripcion`, `organizacion`, `horasActividad`, `vacantes`, `horaInicio`, `fecha`, `lugar`) VALUES (?,?,?,?,?,?,?,?)";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $titulo);
        $sql->bindValue(2, $descripcion);
        $sql->bindValue(3, $organizacion);
        $sql->bindValue(4, $horaActividad);
        $sql->bindValue(5, $vacantes);
        $sql->bindValue(6, $horaInicio);
        $sql->bindValue(7, $fecha);
        $sql->bindValue(8, $lugar);
        
        $result['status'] = $sql->execute();
        return $result;
    }
    public function get_tareas()
    {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM actividades WHERE vacantes > 0" ;
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'idActividad' => (int)$d->idActividad, 'titulo' => $d->titulo,
                'descripcion' => $d->descripcion,'organizacion' => $d->organizacion, 
                'horasActividad' => (int)$d->horasActividad,'vacantes' => (int)$d->vacantes,
                'horaInicio' => $d->horaInicio,'fecha' => $d->fecha,
                'lugar' => $d->lugar
            ];
        }
        return $Array;
    }
 
    function get_usuario() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM usuarios;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function editarActividad($idActividad, $titulo, $descripcion, $organizacion, 
    $horasActividad,$vacantes,$horaInicio, $fecha, $lugar)
    {
        $db = parent::connect();
        parent::set_names();
        $sql = "UPDATE `actividades` SET `titulo`='$titulo',`descripcion`='$descripcion',
        `organizacion`='$organizacion',`horasActividad`='$horasActividad',`vacantes`='$vacantes',
        `horaInicio`='$horaInicio',`fecha`='$fecha',`lugar`='$lugar' WHERE  `idActividad` = $idActividad;";
        $sql = $db->prepare($sql);
        $resultado['estatus'] = $sql->execute();
        return $resultado;

    }

    function get_actividad_x_id($idActividad) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM actividades WHERE idActividad = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idActividad);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
    public function deleteActividad($idActividad)
    {
        $db = parent::connect();
        parent::set_names();
        $sql = "DELETE FROM `actividades` WHERE idActividades = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idActividad);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }
    public function getActividadesProceso()
    {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT u.rfc , u.nombres, u.apellidoP, u.apellidoM , a.organizacion,a.lugar,a.fecha,
		time_format(a.horaInicio, '%h:%i %p') AS horaInicio ,a.horasActividad
        FROM actividades AS a
        INNER JOIN usuarioactividad AS ua
        ON a.idActividad = ua.idActividad
        INNER JOIN usuarios AS u ON ua.idUsuario= u.idUsuario
        WHERE ua.estado = 1;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getActividadesPendientes()
    {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT u.rfc , u.nombres, u.apellidoP, u.apellidoM , a.organizacion, a.horasActividad, ua.evidencia
        FROM actividades AS a
        INNER JOIN usuarioactividad AS ua
        ON a.idActividad = ua.idActividad
        INNER JOIN usuarios AS u ON ua.idUsuario= u.idUsuario
        WHERE ua.estado = 2;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getActividadesTerminada()
    {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT u.rfc , u.nombres, u.apellidoP, u.apellidoM , a.organizacion,a.lugar,a.fecha,
		time_format(a.horaInicio, '%h:%i %p') AS horaInicio ,a.horasActividad
        FROM actividades AS a
        INNER JOIN usuarioactividad AS ua
        ON a.idActividad = ua.idActividad
        INNER JOIN usuarios AS u ON ua.idUsuario= u.idUsuario
        WHERE ua.estado = 3;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

}