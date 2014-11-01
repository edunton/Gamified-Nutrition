<?php namespace Interfaces;
/*
    Interface for Nutritionix Fascade
    by Eric Dunton
 */

interface INutritionixFacade 
{
    public function search($item,$brand,$offset);
    public function getItem($item_id);
}
?>