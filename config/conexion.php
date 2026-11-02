<?php
class Conectar
{
    protected $dbh;

    protected function conexion()
    {
        try {
            $conectar = $this->dbh = new PDO(
                "mysql:host=localhost;dbname=ventas",
                "root",
                ""
            );
            return $conectar;
        } catch (Exception $e) {
            print "Error BD: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function set_names()
    {
        return $this->dbh->query("SET NAMES 'utf8'");
    }
}