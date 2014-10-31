<?php
/*
* Wrapper library of Nutritionix API
* by Eric Dunton
*/

include 'nutritionix.v1.1.php';

//Generates nutritionix object with an ID and Key
function get_nutritionix_object()
{
    return new Nutritionix('b9d26d82','0040418c4ee14912d7a8259c4f67b2ab');
}

//Get ID, name and brand from hit object
function get_results_from_hit($hit)
{
    $fields = $hit->fields;
    $ret = array();
    $ret['item_id'] = $fields->item_id;
    $ret['item_name'] = $fields->item_name;
    $ret['brand_name'] = $fields->brand_name;
    return $ret;
}

?>