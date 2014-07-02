<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 4/18/14
 * Time: 5:49 PM
 */

include_once('bootstrap.php');

if($_POST['code'] == "persist_projects_from_dashboard"){
    //echo "persist_projects_from_dashboard";
    //echo $_POST['stream'];
    $stream = explode("\n",$_POST['stream']);
    //echo var_dump($USER);

    $db = DB::createConn();
    $sql = "DELETE FROM user_projects WHERE user_id={$USER->id}";
    //echo $sql;
    //echo $sql; die();
    $result = mysqli_query($db,$sql);
    if(!$result){
        //TODO: Add this to a context object that is serialized and resturned
        echo "ERROR attempting to remove existing projects [sql:{$sql}]";
    }

    $sql = "INSERT INTO user_projects (user_id,project_name,does_use,does_fsupport,does_contribute,annual_support_usd) VALUES ";

    foreach($stream as $key=>$project){
        $proj = explode(":",$project);
        $does_use = (strpos($proj[2],"u") !== false) ? 1 : 0 ;
        $does_fsupport = (strpos($proj[2],"f") !== false) ? 1 : 0 ;
        $does_contribute = (strpos($proj[2],"c") !== false) ? 1 : 0 ;
        $usd_support = (strpos($proj[1],"$") !== false) ? str_replace("$","",$proj[1]) : $proj[1] ;

        if(strlen($proj[0]) > 0){
            if($key > 0) {
                $sql .= ",";
            }
            $sql .= "( {$USER->id},'{$proj[0]}',{$does_use},{$does_fsupport},{$does_contribute},{$usd_support} )";
        }
    }

    $result = mysqli_query($db,$sql);
    if(!$result){
        //TODO: Add this to a context object that is serialized and resturned
        echo "ERROR attempting to insert new projects [sql:{$sql}]";
    }

    mysqli_close($db);

}

if($_POST['action'] == "getPointSystem"){
    //echo "HELLO FROM AJAX - {$_POST['point_system_id']}";

    $context = array();
    $context["points"] = array();

    $db = DB::createConn();
    $sql = "SELECT p.id,p.name,(select concat(time_created,'^',data) from point_history where point_id=p.id order by time_created DESC limit 1) as 'time_and_data' FROM points p WHERE p.point_system_id={$_POST['point_system_id']}";
    //echo $sql; die();
    $result = mysqli_query($db,$sql);

    while($row = mysqli_fetch_array($result)){
        $time_and_data = explode("^",$row["time_and_data"]);
        $context["timestamp"] = $time_and_data[0];
        $point = array(
            "id" => $row["id"],
            "name" => $row["name"],
            "data" => $time_and_data[1]
        );
        array_push($context["points"],$point);
    }

    echo json_encode($context);

}