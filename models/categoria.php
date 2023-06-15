<?php
require_once("../conexion.php");

class Categoria extends Conexion {
    
    // Crea aquí tus funciones
    function agregarCategoria($nombre_c, $com_c, $banner_c) {
        $db = parent::connect();
        parent::set_names();
        $sql = "INSERT INTO categoria(nombre_c, com_c, banner_c) VALUES(?,?,?);";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $nombre_c);
        $sql->bindValue(2, $com_c);
        $sql->bindValue(3, $banner_c);
        return $sql->execute();
    }

    function traerCategorias() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM categoria;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}