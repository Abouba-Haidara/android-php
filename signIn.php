<?php
$response = array("error" => FALSE);
require_once 'DB.php';
$db = new DB();
if(isset($_POST['login']) &isset($_POST['password']))
{
    $login = $_POST['login'] ;
    $password =  $_POST['password'];
    $sql =  "SELECT * FROM authentifier WHERE  password=:password AND  (login=:login OR email=:login)" ;
    $user  = $db->myQuery($sql,['password'=>$password, 'login'=>$login])->fetch() ;
    if( $user !=null)
    {
        $response['error'] =  false;
        //$response['user']['uid'] = $user->id;
        $response['user']['name'] = $user->username;
        //$response["user"]["created_at"] = $user->created_at;
        //$response["user"]["updated_at"] = $user->updated_at;
        print json_encode($response);
    }else
    {
        $response['error'] = true;
        $response["error_msg"] = "Les informations d'identification de connexion sont erronées!";
        print json_encode($response);
    }

}
else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Parametre login password manquant !";
    print json_encode($response);
}