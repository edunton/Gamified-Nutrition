<?php

class NavElement {
	
	private $label;
	private $link; 
	private $position; // left or right on the nav bar
	
	public function __construct($label, $link, $position) {
		$this->setLabel($label);
		$this->setLink($link);
		$this->setPosition($position);
	}
	
	private function setLabel($newLabel) {
		$this->label = $newLabel;
	}
	
	private function getLabel() {
		return $this->label;
	}
	
	private function setLink($newLink) {
		$this->link = $newLink;
	}
	
	private function getLink() {
		return $this->link;
	}
	
	private function setPosition($newPos) {
		return $this->$newPos;
	}
	
	private function getPosition() {
		return $this->position;
	}
}

?>
