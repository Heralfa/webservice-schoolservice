<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Usuario extends Conexion {

    public function login($correo, $pass) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT idUsuario, pass, tipo FROM usuarios WHERE correo = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->execute();
        $query = $sql->fetch();
        if ($query && password_verify($pass, $query['pass'])) {
            $result['idUsuario'] = $query['idUsuario'];
            $result['tipo'] = $query['tipo'];
            
        } else {
            $result['idUsuario'] = 0;
        }

        return $result;
    }

    public function agregarUsuario( $nombres, $apellidoP, $apellidoM, $rfc, $correo,$pass,$carrera) {
        $link = parent::connect();
        parent::set_names();
        $passencrypt = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `usuarios`( `nombres`, `apellidoP`, `apellidoM`, `rfc`, `correo`, `pass`, `carrera` ) VALUES (?,?,?,?,?,?,?)";
        $sql = $link->prepare($sql);
        $sql->bindValue(1, $nombres);
        $sql->bindValue(2, $apellidoP);
        $sql->bindValue(3, $apellidoM);
        $sql->bindValue(4, $rfc);
        $sql->bindValue(5, $correo);
        $sql->bindValue(6, $passencrypt);
        $sql->bindValue(7, $carrera);

        try {
            $result['status'] = $sql->execute();        
        } catch (PDOException $e) {
            $result['code'] = $e->getCode();
        } finally {
            return $result;
        }
    }

    function get_usuario() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM usuarios WHERE tipo = 1;";
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

    function editarUsuario($idUsuario,$nombres, $apellidoP, $apellidoM, $rfc, $correo,$pass,$carrera){
        $db = parent::connect();
        parent::set_names();
        $passencrypt = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "UPDATE `usuarios` SET `nombres`='$nombres',`apellidoP`='$apellidoP',
        `apellidoM`='$apellidoM',`rfc`='$rfc',`correo`='$correo',
        `pass`='$passencrypt',`carrera`='$carrera' WHERE  `idUsuario` = $idUsuario;";
        $sql = $db->prepare($sql);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }
    
    function editarhoras($idUsuario,$horas){
        $db = parent::connect();
        parent::set_names();
        $sql = "UPDATE `usuarios` SET `horas`=($horas + `horas`  ) WHERE  `idUsuario` = $idUsuario;";
        $sql = $db->prepare($sql);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }



}
