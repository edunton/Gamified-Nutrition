<?php 

require_once 'SplClassLoader.php';
//require 'config.php';

$spl = new SplClassLoader(null,__DIR__);
$spl->register();

define('SITE_ROOT','/Gamified-Nutrition/');

?>