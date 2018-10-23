<?php

if(isset($_COOKIE["popoto"]))
{
    var_dump($_COOKIE);
    //echo $_COOKIE["popoto"];
}
else
{
    setcookie('popoto', 'xesquedeile', time() + 3600);
}