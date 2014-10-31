<?php namespace Interfaces;
/*
    Interface for Navagation Bar
    by Eric Dunton
 */

require 'InterfaceMain.php';

interface INavBar 
{
    public function addElement(INavElement $element);
}
?>