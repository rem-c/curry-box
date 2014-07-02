<?php

include('DB.php');
//echo "mpntaskfunnel received: ". $_POST['context'];

$context = json_decode($_POST['context']);

//echo "context contents:\n" . var_dump($context);

$db = DB::createConn();
$sql = "INSERT INTO point_history (id,point_id,data) VALUES ";
//$sql = "INSERT INTO point_history (id,point_id,data) VALUES ('',{$point_id},'{$temp}')";

foreach($context->points as $index=>$point){
    if($index > 0){
        $sql .= ",";
    }
    $sql .= "('',{$point->id},'{$point->data}')";

}

$result = mysqli_query($db,$sql);

echo $sql;
?>