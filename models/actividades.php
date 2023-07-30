<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Actividades extends Conexion {
    
    function insertarTarea($titulo, $descripcion, $organizacion, $horaActividad,$vacantes,$horaInicio,
    $fecha,$lugar) {
        $db = parent::connect();
        parent::set_names();
        $sql = "INSERT INTO `usuarios`( `titulo`, `descripcion`, `organizacion`, `horasActividad`, `vacantes`, `horaInicio`, `fecha`, `lugar`, `estado`) VALUES (?,?,?,?,?,?,?,?,?,?)";
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
        $sql = "SELECT * FROM actividades;";
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


    function get_actividad_x_id($idUsuario) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM usuarios WHERE idUsuario = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idUsuario);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
   

}
