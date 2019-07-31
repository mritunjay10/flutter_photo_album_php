<?php
/**
 * Created by PhpStorm.
 * User: mritunjay
 * Date: 6/4/19
 * Time: 5:44 PM
 */


class DBConfig
{

    private $host = "localhost";
    private $db_name = "photo_album";
    private $username = "mritunjay";
    private $password = "qwerty";

    public $conn = null;

    public function __construct()
    {
        $this->conn =mysqli_connect("$this->host","$this->username","$this->password","$this->db_name");

        if (!mysqli_connect_errno()){

        }
        else{
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
}
