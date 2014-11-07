<?php

require_once 'Main.php';

use Display\Page as Page;

$page = <<<EOD
<div class="jumbotron">
  <h1>A Message to Eaters Everywhere</h1>
  <p>Start Eating Healthy Now!</p>
  <p><a class="btn btn-primary btn-lg" href="search.php" role="button">Search For Your Favorite Foods</a></p>
</div>
EOD;

$p = new Page('Gamified Nutrition','Welcome to Gamified Nutrition','Now in Beta');
$p->setBodyFromString($page);
echo $p->getPage();
?>
