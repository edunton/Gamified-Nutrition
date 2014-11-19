<?php
namespace Display;
use \Interfaces\INavElement;
define("LEFT",'left');
define("RIGHT",'right');

class NavElement implements INavElement{
	
	private $label;
	private $link; 
	private $position = LEFT; // left or right on the nav bar
	
	public function __construct($label, $link, $position) {
		$this->setLabel($label);
		$this->setLink($link);
		$this->setPosition($position);
	}
	
	public function setLabel($newLabel) {
		$this->label = $newLabel;
	}
	
	public function getLabel() {
		return $this->label;
	}
	
	public function setLink($newLink) {
		$this->link = $newLink;
	}
	
	public function getLink() {
		return $this->link;
	}
	
	public function setPosition($newPos) {
		 $this->position = $newPos;
	}
	
	public function getPosition() {
		return $this->position;
	}
}

?>
