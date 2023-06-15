<?php
require_once("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);

class Venta extends Conexion {
    
    function comprar($idu_v, $monto_v, $desc_v, $mFinal_v, $id_a) {
        $db = parent::connect();
        parent::set_names();
        // Inserta la nueva venta
        $sql = "INSERT INTO venta(idu_v, monto_v, desc_v, mFinal_v) VALUES(?,?,?,?);";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idu_v);
        $sql->bindValue(2, $monto_v);
        $sql->bindValue(3, $desc_v);
        $sql->bindValue(4, $mFinal_v);
        $result['INSERT'] = $sql->execute();

        // Obtiene el id de la venta nueva
        $sql = "SELECT LAST_INSERT_ID() AS idv FROM venta;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $idv_a = $sql->fetch(PDO::FETCH_OBJ)->idv;

        // Actualiza los datos de ususario y venta en el articulo
        foreach ($id_a as $key => $value) {
            $sql = "UPDATE articulo SET idu_a = ?, idv_a = ? WHERE id_a = ?;";
            $sql = $db->prepare($sql);
            $sql->bindValue(1, $idu_v);
            $sql->bindValue(2, $idv_a);
            $sql->bindValue(3, $value);
            $result["UPDATE$key"] = $sql->execute();
        }
        // Obtener el saldo actual del usuario
        $sql = "SELECT saldo_u FROM usuario WHERE id_u = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idu_v);
        $sql->execute();
        $result["DATA"] = $sql->fetch(PDO::FETCH_OBJ);
        
        // Actualizar el saldo del usuario
        $sql = "UPDATE usuario SET saldo_u = ? WHERE id_u = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, ($result["DATA"]->saldo_u) - $mFinal_v);
        $sql->bindValue(2, $idu_v);
        $sql->execute();

        // Obtener al saldo actualizado
        $sql = "SELECT saldo_u FROM usuario WHERE id_u = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idu_v);
        $sql->execute();
        $result["DATA"] = $sql->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    function traerVentas() {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM venta JOIN usuario ON venta.idu_v = usuario.id_u;";
        $sql = $db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    function traerArticulos($id_v) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM venta JOIN articulo ON articulo.idv_a = venta.id_v WHERE venta.id_v = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $id_v);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

    function traerVentasUsuario($idu_a) {
        $db = parent::connect();
        parent::set_names();
        $sql = "SELECT * FROM venta JOIN articulo ON articulo.idv_a = venta.id_v WHERE articulo.idu_a = ?;";
        $sql = $db->prepare($sql);
        $sql->bindValue(1, $idu_a);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_OBJ);
    }

}

?>