<?php

/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 4/19/2017
 * Time: 10:00 PM
 */
require_once($_SERVER['DOCUMENT_ROOT']."/home/config.php");
class DbLoader{
    private $_connection;
    private static $_instance; //The single instance
    public static function getInstance()
    {
        if (!self::$_instance)
            self::$_instance = new self();
        return self::$_instance;
    }
    private function __construct()
    {
        $this->_connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
//        $this->_connection->query("SET NAMES utf8");
//        $this->_connection->query("SET CHARACTER SET utf8");
        $this->_connection->set_charset('utf8');
//        $this->_connection->set_charset('utf-8');
        if (mysqli_connect_error()) {
            trigger_error("Failed to connection to MySQL: " .mysql_connect_error(), E_USER_ERROR);
        }
    }


    private function __clone()
    {
    }


    public function getConnection()
    {
        return $this->_connection;
    }
    public function query($sql){
        return $this->_connection->query($sql);
    }
    public function closeConnect(){
        $this->_connection->close();
    }
}