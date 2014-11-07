<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/6/2014
 * Time: 11:48 PM
 */

require_once 'Main.php';

use Display\ResultPage as RP;

if(isset($_GET['item']))
{
    $rp = new RP($_GET['item']);
    echo $rp->getPage();
}
else
{
    echo 'whoops';
}

?>