<?php

$body = trim(file_get_contents('php://input'));

#boa pratica
$obj_json = json_decode($body, true);


echo ($obj_json["produto"]);