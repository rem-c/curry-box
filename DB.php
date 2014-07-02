<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 5/18/14
 * Time: 5:28 PM
 */

class DB {
    static function createConn(){

        $conn=mysqli_connect("localhost","root","cu55yb0x","curry_box_test");

        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }else{
            return $conn;
        }
    }
}
