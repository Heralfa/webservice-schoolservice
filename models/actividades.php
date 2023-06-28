<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Actividades extends Conexion {
    
    function insertarTarea($titulo, $descripcion, $organizacion, $horaActividad,$vacantes,$horaInicio,
    $fecha,$lugar,$estado) {
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
        $sql->bindValue(9, $estado);
        
        $result['status'] = $sql->execute();
        return $result;
    }


    public function login($correo,$pass){
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT idUsuario, correo, pass FROM usuarios WHERE correo= ? AND pass = ?;";       
         $sql = $db->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->bindValue(2, $pass);
        $sql->execute();
        $query = $sql->fetch();
        if ($pass = $query['pass']) {
            $result['idUsuario'] = $query['idUsuario'];

        } else {
            $result['idUsuario'] = 0;        }
        return $result;

    }

  
    

    public function agregarUsuario( $nombres, $apellidoP,$apellidoM, $rfc, $correo,$pass,$carrera) {
        $link = parent::connect();
        parent::set_names();
        $passencrypt = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `usuarios`( `nombres`, `apellidoP`, `apellidoM`, `rfc`, `correo`, `pass`, `carrera` ) VALUES (?,?,?,?,?,?,?)";
        $sql = $link->prepare($sql);
        $sql->bindValue(1, $nombres);
        $sql->bindValue(2, $apellidoP);
        $sql->bindValue(3, $apellidoM);
        $sql->bindValue(4, $passencrypt);
        $sql->bindValue(5, $correo);
        $sql->bindValue(6, $rfc);
        $sql->bindValue(7, $carrera);
    
        $result['status'] = $sql->execute();
        return $result;
    }
 
    function get_usuario() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM usuarios;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }


    function get_usuario_x_id($idUsuario) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM usuarios WHERE idUsuario = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idUsuario);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
   

}
