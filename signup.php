<?php
require_once 'DB.php';
$db = new DB();

function checkEmailTaken($email)
{
    return false;
}
$response = array("error" => FALSE);
if(isset($_POST['username']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password'])&& isset($_POST['token']))
{
    $username = htmlentities(trim(base64_encode($_POST['username'])));
    $lastname =  htmlentities(trim(base64_encode($_POST['lastname'])));
    $email =  htmlentities(trim(base64_encode($_POST['email'])));
    $password =  htmlentities(trim(base64_encode($_POST['password'])));
    $token =  htmlentities(trim(base64_encode($_POST['token'])));


    if(!empty ($username) && !empty($email) && !empty($lastname) && !empty($password) && !empty($token))
    {
        $req =  "SELECT email FROM authentifier WHERE email=?";
        if(!$db->myQuery($req,[$email])->fetch())
        {
            $sql = "INSERT INTO authentifier SET username=?, lastname=?, email=?, password=?, token =?,created_at = NOW(), updated_at = NOW()";
            if ($db->myQuery($sql,[$username,$lastname, $email,$password, $token ]))
            {
                $response['error'] = false ;
                $response['user']['uniqID']   = uniqid($db->getLastInsert());
                $response['user']['username'] = base64_decode($username);
                $response['user']['lastname'] = base64_decode($lastname);
                $response['user']['email']    = base64_decode($email) ;
                $response['user']['password'] = base64_decode($password) ;
                $response['user']['token']    = base64_decode($token);
                $response['user']['created_at'] = date('d:m:Y H:i:s');
                print json_encode($response);
            }else
            {
                $response['error'] = TRUE;
                $response["error_msg"] =" Une erreur inconnue s'est produite lors de l'enregistrement!";
                print json_encode($response);
            }
        }else
        {
            $response['error'] = TRUE;
            $response["error_msg"] ="cet email est deja pris!";
            print json_encode($response);
        }

    } else {
        $response['error'] = TRUE;
        $response["error_msg"] ="Tout le champ sont obligatoire";
        print json_encode($response);
    }

}else
{
    $response['error'] = TRUE;
    $response["error_msg"] ="Aucu  champ ne defini";
    print json_encode($response);
}


?>