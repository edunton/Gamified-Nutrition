<?php namespace Interfaces;
/*
    Interface for Pages
    by Eric Dunton
 */

require 'InterfaceMain.php';

interface IPage 
{
    public function setNavBar(INavBar $bar);
    public function setBodyFromString($body);
    public function setBodyFromCallable(callable $call);
    public function getPage();
}
?>