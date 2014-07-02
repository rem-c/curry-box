<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 5/18/14
 * Time: 5:23 PM
 */
include_once("DB.php");

$db = DB::createConn();

$sql = "INSERT INTO point_history (id,point_id,time_created,data) VALUES ";


foreach(json_decode($_POST['points']) as $i=>$point){
    if($i == 0){
        $sql .= "('',{$point->point_id},{$point->time_created},{$point->data})";
    }else{
        $sql .= ",('',{$point->point_id},{$point->time_created},{$point->data})";

    }
}

mysqli_query($db,$sql);

mysqli_close($db);