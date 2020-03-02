<?php

require_once  'DB.php' ;
$db =  new DB();
$cpt=0;
foreach($db->myQuery("select * from authentifier")->fetchAll() as $k=>$v)
{
    $response['user']['id'][$cpt] = base64_decode( $v->id) ;
    //$response['user']['username'][$cpt] = base64_decode( $v->username) ;
    //$response['user']['lastname'][$cpt] = base64_decode( $v->lastname) ;
    $response['user']['email'][$cpt] = base64_decode( $v->username) ;
    $response['user']['username'][] = base64_decode( $v->username) ;
    $response['user']['username'][] = base64_decode( $v->username) ;
    $response['user']['username'][] = base64_decode( $v->username) ;
    $response['user']['username'][] = base64_decode( $v->username) ;
    $cpt++;
}