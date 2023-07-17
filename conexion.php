<?php
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=utf-8");
header("Access-Control-Allow-Headers: Authorization, Cache-Control, Content-Type, X-Requested-With");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, INSERT, DELETE, insertUser, deleteUser, PATCH, PUT, HEAD");

class Conexion
{
    protected $db;
    protected function connect()
    {
        try {
            $NAMEDB = 'heroku_f0892f425b6a996';
            $HOST = 'us-cdbr-east-06.cleardb.net';
            $USER = 'b7dd1dc725a7e7';
            $PASSWORD = '18c6ea4f';
            $conectar = $this->db = new PDO("mysql:host=$HOST;dbname=$NAMEDB", "$USER", "$PASSWORD");
            return $conectar;
        } catch (Exception $e) {
            print "¡Error BD!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names()
    {
        return $this->db->query("SET NAMES 'utf8'");
    }
}
