<?php
if ($_COOKIE["session"]) {
    session_id($_COOKIE["session"]);
}
session_start();
setcookie("session", session_id(), time()+1800); 

$url = "https://jonchang.site/api/static";
$data = array("allow_js" => "false", 
    "allow_images" => "true",
    "session_id" => session_id(), 
    "language" => explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE'])[0],
    "agent" => $_SERVER['HTTP_USER_AGENT']);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

var_dump($result);
?>