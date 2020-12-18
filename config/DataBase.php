<?php

class DataBase
{
    public static function conexionDB()
    {
        try {
            $conn = new mysqli('localhost', 'root', '', 'tienda_master');
            $conn->query(" SET NAMES 'utf8' ");
            return $conn;
        } catch (mysqli_sql_exception $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
}
