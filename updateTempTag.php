<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 5/26/14
 * Time: 4:19 PM
 */

include('DB.php');

//receive all variables from $_GET

$point_id = $_GET['0'];
$temp = $_GET['2'];

$db = DB::createConn();
$sql = "INSERT INTO point_history (id,point_id,data) VALUES ('',{$point_id},'{$temp}')";
//echo $sql; die();
$result = mysqli_query($db,$sql);

echo "point_id is $point_id<br/>";
echo "temp is $temp<br/>";
echo "sql is $sql<br/>";