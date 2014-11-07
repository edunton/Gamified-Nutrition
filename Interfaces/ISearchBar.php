<?php namespace Interfaces;
/*
    Interface for Search Bar
    by Eric Dunton
 */

interface ISearchBar 
{
    public function __construct($search_output);
    public function display($container_id,$container_class,$prev_item,$prev_brand);
}
?>