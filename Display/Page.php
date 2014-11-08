<?php namespace Display;

//require 'DisplayMain.php';

use \Interfaces\IPage as IPage;
use \Interfaces\INavBar as INavBar;

class Page implements IPage
{
    private $pageBody;
    private $head = '';
    private $header_add_on = '';
    private $bar = '';
    private $foot = '';

    private static function set_up_header($header_params)
    {
        $retStr = '';
        if(is_array($header_params))
        {
            $styles = function($s){return '<link rel="stylesheet" href="'.$s.'">';};
            $scripts = function($s){return '<script type="text/javascript" src="'.$s.'">';};
            if(isset($header_params['styles']))
            {
                $retStr .= implode(array_map($styles,$header_params['styles']));
            }
            if(isset($header_params['scripts']))
            {
                $retStr .= implode(array_map($scripts,$header_params['scripts']));
            }
        }
        return $retStr;
    }
    public function __construct($title, $header, $sub_header, $head_params = null)
    {
        if($head_params != null)
            $this->header_add_on = self::set_up_header($head_params);
        $this->pageBody = '';
        $this->head = <<<EOD
<html>
    <head>
        <title>$title</title>
        <link rel="stylesheet" href="styles/bootstrap.css">
        $this->header_add_on
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            $this->bar
            <div class="page-header">
                <h1>$header <small>$sub_header</small></h1>
            </div>
EOD;
        $this->foot = '</div></body></html>';
    }

    public function setNavBar(INavBar $bar)
    {
        $this->bar = $bar->display('NavBar','');
    }
    public function setBodyFromString($body)
    {
        $this->pageBody = $this->pageBody.$body;
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