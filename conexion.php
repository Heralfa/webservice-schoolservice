<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

class Conexion
{
    protected $db;
    protected function connect()
    {
        try {
            $NAMEDB = 'heroku_01880f68154639e';
            $HOST = 'us-cdbr-east-06.cleardb.net';
            $USER = 'bfac196785def5';
            $PASSWORD = '265ee66a';
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
