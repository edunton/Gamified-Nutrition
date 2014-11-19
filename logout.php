<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/18/2014
 * Time: 4:38 PM
 */
setcookie("user", "", time()-3600);
header("Location: index.php");
die();

?>