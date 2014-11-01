<?php namespace Display;

require 'DisplayMain.php';

use \Interfaces\IPage as IPage;
use \Interfaces\INavBar as INavBar;

class Page implements IPage
{
    private $pageBody;
    private $head;
    private $foot;

    public function __construct($title)
    {
        $this->pageBody = '';
        $this->head = <<<EOD
<html>
    <head>
        <title>$title</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
EOD;
        $this->foot = '</div></body></html>';
    }

    public function setNavBar(INavBar $bar)
    {
        //void for now
    }
    public function setBodyFromString($body)
    {
        $this->pageBody = $body;
    }
    public function setBodyFromCallable(callable $call)
    {
        ob_start();
        $call();
        $this->pageBody = $this->pageBody.ob_get_contents();
        ob_end_clean();
    }
    public function getPage()
    {
        return $this->head.$this->pageBody.$this->foot;
    }
}

?>