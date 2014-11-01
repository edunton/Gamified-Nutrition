<?php namespace Interfaces;
/*
    Interface for Navagation Buttons
    by Eric Dunton
 */

interface INavElement 
{
    public function setLabel($setLabel);
    public function getLabel();
    public function setLink($link);
    public function getLink();
}
?>