<?php
class Conexion
//modificar
{
    public static function StartUp()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=catastro;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
        return $pdo;
    }
}
?>
