<?php
namespace Display;
use \Interfaces\INavElement;
use Interfaces\INavBar;

class NavBar implements INavBar{



	private $login; // whether the user is signed in
    private $navLeft;

    public function __construct($login = null)
    {
        $this->login = $login;
        $this->navLeft =
        '<nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Gamified Nutrition</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
	';
    }
          
    private $navRight = 
    '</ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> %s</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    ';

    private $navRightNotLogged =
        '</ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#signup" data-toggle="modal" data-target=".bs-modal-sm">
            <span class="glyphicon glyphicon-log-in"></span> Login/Register</a></li>
    ';
       
    private $navEnd = '      
          </ul>
        </div>
      </div>
    </nav>'; 
	
	public function addElement(INavElement $element) {
		$position = $element->getPosition();
		$label = $element->getLabel();
		$link = $element->getLink();
		
		if ($position == LEFT) {
			$li = '<li><a href="'.$link.'">'.$label.'</a></li>'; // <li><a href="link">label</a></li>
			$this->navLeft .= $li;
		} else {
			$li = '<li><a href="'.$link.'"><span class="glyohicon glyphicon-asterisk"></span> '.$label.'</a></li>';
			$this->navRight = $li.$this->navRight;
            $this->navRightNotLogged = $li.$this->navRightNotLogged;
	    }
    }
	
	public function display() {
        if($this->login != NULL)
		    $html = $this->navLeft.sprintf($this->navRight,$this->login).$this->navEnd;
        else
            $html = $this->navLeft.$this->navRightNotLogged.$this->navEnd;
		return $html;
	}

}


?>
