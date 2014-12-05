<?php

require_once 'Main.php';

use Facade\UserProfileFacade as UPF;

if(!isset($_COOKIE['user']))
{
    header("Location: login.php");
    die();
}
else
{
    $cook = htmlspecialchars($_COOKIE['user']);
    if(UPF::get_user_by_cookie($cook))
    {
        header("Location: homepage.php");
        die();
    }
    else{
        header("Location: login.php");
        die();
    }
}

?>
