<?php
require_once("../conexion.php");

class Articulo extends Conexion {
    
    // Crea aquí tus funciones
    function insertarProducto($nombre_a, $precio_a, $img_a, $idcat_a) {
        $db = parent::connect();
        parent::set_names();
        $sql = "INSERT INTO articulo(nombre_a, precio_a, img_a, idcat_a) VALUES (?,?,?,?);";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $nombre_a);
        $sql->bindValue(2, $precio_a);
        $sql->bindValue(3, $img_a);
        $sql->bindValue(4, $idcat_a);
        return $sql->execute();
    }

    function obtenerProductos() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM articulo WHERE idv_a IS NULL;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    function obtenerProductosxCategoria($idcat_a) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM articulo WHERE idcat_a = ? AND idv_a IS NULL;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idcat_a);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}