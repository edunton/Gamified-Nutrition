<?php namespace Display;

//require 'DisplayMain.php';

use \Interfaces\IPage as IPage;
use \Interfaces\INavBar as INavBar;
use \Facade\UserProfileFacade as UPF;

class Page implements IPage
{
    private $pageBody;
    private $head = '';
    private $header_add_on = '';
    private $bar = '';
    private $foot = '';
    private $userID = null;


    public function __construct($title, $header, $sub_header, $head_params = null, $extra = '')
    {
        if(isset($_COOKIE['user']))
        {
            $user = UPF::get_user_by_cookie($_COOKIE['user']);
            if($user)
            {
                $this->userID = $user->UserID;
            }
        }

        if($head_params != null)
            $this->header_add_on = self::set_up_header($head_params);
        $this->stdBar();
        $this->pageBody = '';
        $this->head = <<<EOD
<html>
    <head>
        <title>$title</title>
        <link rel="stylesheet" href="styles/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="styles/bootstrap/css/bootstrap-theme.css">
        <link rel="stylesheet" href="styles/hello.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="styles/bootstrap/js/bootstrap.js"></script>
        $this->header_add_on
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        $this->bar
        <div class="container">
            <div class="page-header">
                <h1>$header <small>$sub_header</small></h1>
            </div>
EOD;
        $modal = LoginModal::display('login.php','signup.php');
        $this->foot = "</div>$modal $extra</body></html>";
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

    public function getUser()
    {
        return $this->userID;
    }

    public function setUser($id)
    {
        $this->userID = $id;
    }

    private static function set_up_header($header_params)
    {
        $retStr = '';
        if(is_array($header_params))
        {
            $styles = function($s){return '<link rel="stylesheet" href="'.$s.'">';};
            $scripts = function($s){return '<script type="text/javascript" src="'.$s.'"></script>';};
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
    private function stdBar()
    {
        $ne1 = new navElement('Enter Data','search.php',LEFT);
        $ne2 = new navElement('History','history.php',LEFT);
        $ne3 = new navElement('Achievements','achievements.php',LEFT);
        $ne4 = new navElement('Statistics','statistic.php',LEFT);

        if($this->userID != null)
        {
            //echo $this->userID;
            $user = UPF::get_user_by_id($this->userID);
            $nb = new navBar($user->UserName);
            $nb->addElement($ne1);
            $nb->addElement($ne2);
            $nb->addElement($ne3);
            $nb->addElement($ne4);
            $this->bar = $nb->display();
        }
        else
        {
            $nb = new navBar();
            $this->bar = $nb->display();
        }
    }
}

?>
