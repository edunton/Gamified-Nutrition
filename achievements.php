<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 12/6/2014
 * Time: 2:32 PM
 */
require_once 'Main.php';

use Display\AchievementsPage as AP;

$ap = new AP();
echo $ap->getPage();

?>