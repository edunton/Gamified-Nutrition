<?php namespace Interfaces;
/*
    Interface for Pages
    by Eric Dunton
 */

interface ISearchBar 
{
    //public function search($item,$brand);
    //public function set_offset($offset);
    //public function set_search_output_dest($link);
    //public function set_result_output_dest($link);
    public function __construct($search_output);
    public function display($container_id,$container_class,$prev_item,$prev_brand);
}
?>