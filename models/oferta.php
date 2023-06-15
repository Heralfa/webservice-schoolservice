<?php
require_once("../conexion.php");

class Oferta extends Conexion {
    
    // Crea aquí tus funciones
    function insertarOferta($desc_o, $fechain_o, $fechafin_o, $banner_o) {
        $db = parent::connect();
        parent::set_names();
        $sql = "INSERT INTO oferta(desc_o, fechain_o, fechafin_o, banner_o) VALUES(?,?,?,?);";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $desc_o);
        $sql->bindValue(2, $fechain_o);
        $sql->bindValue(3, $fechafin_o);
        $sql->bindValue(4, $banner_o);
        return $sql->execute();
    }

    function obtenerOfertas() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM oferta;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }
}