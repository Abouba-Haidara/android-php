                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

require_once  'DB.php' ;
function getData()
{
    $db = new DB();
    $cpt = 0;
    $array = array();
    foreach ($db->myQuery("select id, name, image,status, profilePic, UNIX_TIMESTAMP(timesStamp) as timesStamp, url from feed")->fetchAll() as $k => $v) {
        $response = [
            'id' => $v->id,
            "name" => $v->name,
            "image" => $v->image,
            "status" => $v->status,
            "profilePic" => $v->profilePic,
            "timeStamp" =>   $v->timesStamp,
            "url" => $v->url
        ];
        //array_push($array, $response);
        $array["feed"][$cpt++] = $response;

    }
    return json_encode($array);
}


$file_name = "feed1.json";
if(file_put_contents($file_name, getdata()))
{
    echo $file_name . ' File created';
}
else
{
    echo 'There is some error';
}