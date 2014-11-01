<?php
/*
* Wrapper library of Nutritionix API
* by Eric Dunton
*/

use Interfaces\INutritionixFacade as INutritionixFacade;
use Data\Nutritionix as API;

class NutritionixFacade implements INutritionixFacade
{
    private $api;

    public function __construct()
    {
        //Generates nutritionix object with an ID and Key
        $this->api = new API('b9d26d82','0040418c4ee14912d7a8259c4f67b2ab');
    }

    public function search($item,$brand,$offset)
    {
        $result = $api->search($item,$brand,$offset);

        if (isset($results->hits))
        {
            return array_map('get_results_from_hit', $results->hits);
        }
        else
        {
            return NULL;
        }
    }

    public function getItem($item_id)
    {
        return $this->api->getItem($item_id,'id');
    }

    //Get ID, name and brand from hit object
    private static function get_results_from_hit($hit)
    {
        $fields = $hit->fields;
        $ret = array();
        $ret['item_id'] = $fields->item_id;
        $ret['item_name'] = $fields->item_name;
        $ret['brand_name'] = $fields->brand_name;
        return $ret;
    }
}



?>