<?php 

function __autoload($class)
{
    require str_replace('\\',DIRECTORY_SEPERATOR,$class).'.php';
}

?>