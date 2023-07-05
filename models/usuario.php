<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Usuario extends Conexion {
    
    function agregarSaldo($id_u, $saldo_u) {
        $db = parent::connect();
        parent::set_names();
        $sql = "UPDATE usuario SET saldo_u = saldo_u + ? WHERE id_u = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $saldo_u);
        $sql->bindValue(2, $id_u);
        return $sql->execute();
    }


    public function login($correo,$pass){
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT idUsuario, correo, pass,tipo FROM usuarios WHERE correo= ? AND pass = ?;";       
         $sql = $db->prepare($sql);
        $sql->bindValue(1, $correo);
        $sql->bindValue(2, $pass);
        // $sql->bindValue(3, $tipo);
        $sql->execute();
        $query = $sql->fetch();

        if ($pass = $query['pass']) {
            $result['idUsuario'] = $query['idUsuario'];
            $result['tipo'] = $query['tipo'];

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
