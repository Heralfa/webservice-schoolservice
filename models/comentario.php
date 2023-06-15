<?php
require_once("../conexion.php");

class Comentario extends Conexion {
    
    // Crea aquí tus funciones
    function insertarComentario($com, $idu_com, $ida_com) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SET FOREIGN_KEY_CHECKS = 0;";
        $db->exec($sql);
        $sql = "INSERT INTO comentario(com, idu_com, ida_com) VALUES (?,?,?);";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $com);
        $sql->bindValue(2, $idu_com);
        $sql->bindValue(3, $ida_com);
        $result = $sql->execute();
        $sql = "SET FOREIGN_KEY_CHECKS = 1;";
        $db->exec($sql);
        return $result;
    }

    function obtenerComentario($ida_com) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT comentario.com, comentario.idu_com, usuario.usuario_u FROM comentario JOIN usuario ON usuario.id_u = comentario.idu_com WHERE comentario.ida_com = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $ida_com);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerComentarios() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM comentario JOIN usuario ON comentario.idu_com = usuario.id_u;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    function comentariosXCategoria($id_c) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM comentario JOIN articulo ON comentario.ida_com = articulo.id_a JOIN categoria ON categoria.id_c = articulo.idcat_a JOIN usuario ON comentario.idu_com = usuario.id_u WHERE idcat_a = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $id_c);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    function comentariosXNft($id_a) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM comentario JOIN usuario ON comentario.idu_com = usuario.id_u WHERE comentario.ida_com = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $id_a);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}