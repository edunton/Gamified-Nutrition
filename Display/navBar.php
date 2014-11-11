<?php

class NavBar {
	
	private $status; // whether the user is signed in 
	private $navLeft = 
	'<nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#">Gamified-Nutrition</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
	';
          
    private $navRight = 
    '</ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> %s</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> %s</a></li>
    ';
       
    private $navEnd = '      
          </ul>
        </div>
      </div>
    </nav>'; 
	
	private function addElement($element) {
		$position = $element.getPosition();
		$label = $element.getLabel();
		$link = $element.getLink();
		
		if ($position == left) {
			li = '<li><a href="' + link + '">' + label + '</a></li>'; // <li><a href="link">label</a></li>
			$this->navLeft = navLeft + li;
		} else {
			li = '<li><a href="' + link + '"><span class="glyohicon glyphicon-asterisk"></span> ' + label + '</a></li>';
			$this->navRight = navRight + li;
	}
	
	private function display() {
		$html = $this.navLeft + $this.navRight +$this.navEnd;
		echo $html;
	}
		
	
}


?>
