<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/5/2014
 * Time: 11:56 PM
 *
 * Object for transporting Item information
 * The 'fields()' function defines for the parent Container
 * class what fields the object should have
 */

namespace Facade;
define('DEBUG',0); //set to 1 to test

if(DEBUG)
{
    require_once '..' . DIRECTORY_SEPARATOR . 'Main.php';
}

class ItemInfo extends LockableContainer{

    public function __construct(){
        parent::__construct('NULL');
    }

    protected function fields()
    {
        // Do Not Change Once in Use
        return array(
            'old_id',
            'item_id',
            'item_name',
            'brand_id',
            'brand_name',
            'item_description',
            'updated_at',
            'ingredient_statement',
            'water_grams',
            'calories',
            'calories_from_fat',
            'total_fat',
            'saturated_fat',
            'trans_fatty_acid',
            'polyunsaturated_fat',
            'monounsaturated_fat',
            'cholesterol',
            'sodium',
            'total_carbohydrate',
            'dietary_fiber',
            'sugars',
            'protein',
            'vitaminA',
            'vitaminC',
            'calcium',
            'iron',
            'refuse_pct',
            'servings_per_container',
            'serving_size_qty',
            'serving_size_unit',
            'serving_weight_grams',
            'from_cache'
        );
    }
}

/*
 * An Example of how Lockable container can be used
 */
if(DEBUG)
{

    $a = new ItemInfo('blank');
    $a->item_id = 1234;
    $a->nf_sodium = 'salt';
    $a->nf_total_fat = 'fatty';
    $a->lock();
    try
    {
        $a->brand_id = 123;
    }
    catch (\Exception $e)
    {
        echo '<p>attempeted to set field in locked container</p>';
    }
    foreach($a as $k=>$v)
    {
       echo '<p>'.$k.'::'.$v.'</p>';
    }
    //print_r($a);
}