<?php namespace Interfaces;
/*
    Interface for Navigation Bar
    by Eric Dunton
 */

interface INavBar 
{
    // add element to Nav Bar
    public function addElement(INavElement $element);
    // return string representation of Nav Bar
    public function display();
}
?>