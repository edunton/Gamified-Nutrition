<?php

require 'Main.php';

use Display\Page as Page;

$page = new Page('title');

$mybody = <<<EOD
<h1>Type some html into a string</h1>
<p>and it will produce a body</p>
EOD;

$page->setBodyFromString($mybody);

echo $page->getPage();

?>