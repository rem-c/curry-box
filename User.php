<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 5/18/14
 * Time: 5:30 PM
 */

class User {
    public $Authenticated = FALSE;
    public $id;
    public $name;
    public $email;
    public $username;
    public $context;

    public function User($Authenticated=FALSE,$id='',$name='',$email='',$username=''){
        $this->Authenticated = $Authenticated;
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
    }

    public function isAuthenticated(){
        return $this->Authenticated;
    }

    public function getPointSystems(){
        $db = DB::createConn();
        $sql = "select system.id,system.name,(select count(*) from points where point_system_id=system.id) as 'no_of_points' from point_systems system";
        //echo $sql; die();
        $result = mysqli_query($db,$sql);
        $this->context['point_systems'] = array();
//        $used = 0;
//        $funded = 0;
//        $contributed = 0;
        //echo mysqli_num_rows($result);die();
//        foreach (mysqli_fetch_array($result) as $row){
//            $project = array(
//                "name" => $row["project_name"]
//            );
//            array_push($this->context['oss_projects'],$project);
//            echo "looping";
//        }

        while($row = mysqli_fetch_array($result)){
            $project = array(
                "id" => $row["id"],
                "name" => $row["name"],
                "no_of_points" => $row["no_of_points"]
            );
            array_push($this->context['point_systems'],$project);
        }


//$USER->context = array(
//    "oss_used_count" => "10",
//    "oss_funded_count" => "3",
//    "oss_contributed_count" => "1"
//);
//        $this->context["oss_used_count"] = $used;
//        $this->context["oss_funded_count"] = $funded;
//        $this->context["oss_contributed_count"] = $contributed;


        mysqli_close($db);
        //die();
    }

}

/*
 * 1. if a User object exists in the session, assigng $USER to it, set authenticated = true
 * 2. otherwise, look for credentials in $POST
 * 2.a. and if authentication is successful, create user ojbect, assign it to $USER and session, set authenticated = true
 * 2.b. if authentication is not successful, send user back to login page with error
 * 3. otherwise create default user object and set authenticated = false
 *
 */
$ses_result = session_start();
if(isset($_POST['login_username']) && isset($_POST['login_password'])){

    $user = $_POST['login_username'];
    $pass = $_POST['login_password'];

    $db = DB::createConn();
    $sql = "SELECT * FROM users WHERE username='${user}' AND password=MD5('${pass}')";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result) == 0){
        $_SESSION['USER'] = serialize(new User());
    }else{
        $row = mysqli_fetch_array($result);
        $_SESSION['USER'] = serialize(new User(TRUE,$row['id'],$row['name'],$row['email'],$row['username']));
    }

    session_commit();
    mysqli_close($db);
}

$USER=new User();

if(isset($_SESSION['USER'])){
    $USER = unserialize($_SESSION['USER']);
}else{
    $USER = new User();
}


//stubs for context
//$USER->context = array(
//    "oss_used_count" => "10",
//    "oss_funded_count" => "3",
//    "oss_contributed_count" => "1"
//);





?>