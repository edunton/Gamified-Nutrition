<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/15/2014
 * Time: 5:31 PM
 */

require_once 'Main.php';

$page = new \Display\SignUpPage('signup.php');

echo $page->getPage();

?>