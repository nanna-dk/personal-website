<?php
$args=[
    'usertoken'=>'EAAGIpMAzBowBAI7vnZCdeTPIqjxcPUICJ5k3PorZAxevLSE7BZC6heEOAzNJquDX5IVFcS9epMpZCBypvmRO3MKq3sq3sch8pGvLTZCi8pKl8mpzmsGAZAla3JElLBRnIPxxYQzbVgQ0O5GeMiOBgQj9rKb89skNySZCudx4HZC7yiEGKatWVUKOfiSZBLlK7Lo8ZD',
    'appid'=>'431716157294220',
    'appsecret'=>'121bb08a89d6c00b95aecb260cfd20b1',
    'pageid'=>'nanna.ellegaard'
];

echo 'Permanent access token is: <input type="text" value="'.generate_token($args).'"></input>';
function generate_token($args){
    $r=json_decode(file_get_contents("https://graph.facebook.com/v2.9/oauth/access_token?grant_type=fb_exchange_token&client_id={$args['appid']}&client_secret={$args['appsecret']}&fb_exchange_token={$args['usertoken']}")); // get long-lived token
    $longtoken=$r->access_token;
    $r=json_decode(file_get_contents("https://graph.facebook.com/v2.9/me?access_token={$longtoken}")); // get user id
    $userid=$r->id;
    $r=json_decode(file_get_contents("https://graph.facebook.com/v2.9/{$userid}?fields=access_token&access_token={$longtoken}")); // get permanent token
    if($r->id==$args['pageid']) $finaltoken=$r->access_token;
    return $finaltoken;
}

?>
