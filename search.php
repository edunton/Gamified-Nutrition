<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/6/2014
 * Time: 7:59 PM
 */

require_once 'Main.php';

$sp = new \Display\SearchPage('search.php', "result.php");
echo $sp->getPage();

?>