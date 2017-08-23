<?php
/**
 * Created by PhpStorm.
 * User: lysak
 * Date: 22.08.17
 * Time: 10:52
 */
class Db
{
    public static function getConnection()
    {
        $paramsPath =ROOT.'/config/db_params.php';
        $params = include($paramsPath);


        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        return $db;
    }
}