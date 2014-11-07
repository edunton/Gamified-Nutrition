<?php namespace Facade;
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
        $results = $this->api->search($item,$brand,$offset);

        //Get ID, name and brand from hit object
        $get = function($hit)
        {
            $fields = $hit->fields;
            $ret = array();
            $ret['item_id'] = $fields->item_id;
            $ret['item_name'] = $fields->item_name;
            $ret['brand_name'] = $fields->brand_name;
            return $ret;
        };
        //print_r($results);
        if (isset($results->hits) && isset($results->total))
        {
            return array('total'=>$results->total, 'hits'=>array_map($get, $results->hits));
        }
        else
        {
            return NULL;
        }
    }

    public function getItem($item_id)
    {
        $info = new ItemInfo();
        $infoAPI = $this->api->getItem($item_id,'id');
        self::populate_from_api($info,$infoAPI);
        return $info;
    }

    private static function populate_from_api(ItemInfo $info,$api)
    {
        $info->old_id = $api['old_api_id'];
        $info->item_id = $api['item_id'];
        $info->item_name = $api['item_name'];
        $info->brand_id = $api['brand_id'];
        $info->brand_name = $api['brand_name'];
        $info->item_description = $api['item_description'];
        $info->updated_at = $api['updated_at'];
        $info->ingredient_statement = $api['nf_ingredient_statement'];
        $info->water_grams = $api['nf_water_grams'];
        $info->calories = $api['nf_calories'];
        $info->calories_from_fat = $api['nf_calories_from_fat'];
        $info->total_fat = $api['nf_calories_from_fat'];
        $info->saturated_fat = $api['nf_saturated_fat'];
        $info->trans_fatty_acid = $api['nf_trans_fatty_acid'];
        $info->polyunsaturated_fat = $api['nf_polyunsaturated_fat'];
        $info->monounsaturated_fat = $api['nf_monounsaturated_fat'];
        $info->cholesterol = $api['nf_cholesterol'];
        $info->sodium = $api['nf_sodium'];
        $info->total_carbohydrate = $api['nf_total_carbohydrate'];
        $info->dietary_fiber = $api['nf_dietary_fiber'];
        $info->sugars = $api['nf_sugars'];
        $info->protein = $api['nf_protein'];
        $info->vitaminA = $api['nf_vitamin_a_dv'];
        $info->vitaminC = $api['nf_vitamin_c_dv'];
        $info->calcium = $api['nf_calcium_dv'];
        $info->iron = $api['nf_iron_dv'];
        $info->iron = $api['nf_refuse_pct'];
        $info->servings_per_container = $api['nf_servings_per_container'];
        $info->serving_size_qty = $api['nf_serving_size_qty'];
        $info->serving_size_unit = $api['nf_serving_size_unit'];
        $info->serving_weight_grams = $api['nf_serving_weight_grams'];
        $info->from_cache = 'no hit';

        $info->lock();
    }
}



?>