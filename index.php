<?php

require_once 'Main.php';

use Display\Page as Page;
use Display\SearchBar as SB;

$sb = new SB('search.php');
$displaySB = $sb->display();

$page = <<<EOD
<div class="jumbotron">
  <h1>A Message to Eaters Everywhere</h1>
  <p>Start Eating Healthy Now!</p>
  $displaySB
  <br>
</div>
EOD;

$p = new Page('Gamified Nutrition','Welcome to Gamified Nutrition','Now in Beta');
$p->setBodyFromString($page);
echo $p->getPage();
?>
