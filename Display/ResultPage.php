<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/6/2014
 * Time: 10:36 PM
 */

namespace Display;

use Facade\NutritionixFacade as API;

class ResultPage extends Page{
    public function __construct($item_id)
    {
        $api = new API();
        $info = $api->getItem($item_id);
        parent::__construct($info->item_name.' - '.$info->brand_name,$info->item_name,$info->brand_name);

        $lmd = function() use ($info)
        {
            $hit = "<li class='list-group-item list-group-item-danger'>Cache Miss: Queried the API</li>";
            if($info->from_cache == 'hit') $hit = "<li class='list-group-item list-group-item-success'>
                                                    Cache Hit: Queried the Table</li>";

            echo "<ul class='list-group'>";
            echo $hit;
            echo "<li class='list-group-item'>calories: $info->calories</li>";
            echo "<li class='list-group-item'>calories from fat: $info->calories_from_fat</li>";
            echo "<li class='list-group-item'>carbs: $info->total_carbohydrate</li>";
            echo"</ul>";
        };
        $this->setBodyFromCallable($lmd);
    }
} 