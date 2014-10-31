<?php namespace Interfaces;
/*
    Interface for Pages
    by Eric Dunton
 */

require 'InterfaceMain.php';

interface ISearchBar 
{
    public function search($item,$brand);
    public function set_search_output_dest($link);
    public function set_result_output_dest($link);
}
?>