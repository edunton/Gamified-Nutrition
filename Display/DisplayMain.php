<?php

function __autoload($class)
{
    require '..'.DIRECTORY_SEPERATOR.str_replace('\\',DIRECTORY_SEPERATOR,$class).'.php';
}
?>