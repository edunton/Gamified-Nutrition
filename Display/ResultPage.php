<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/6/2014
 * Time: 10:36 PM
 * Edit by Sida : 'Add to history' function
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
            echo "<li class='list-group-item'>Calories: $info->calories</li>";
            echo "<li class='list-group-item'>Calories from fat: $info->calories_from_fat</li>";
            echo "<li class='list-group-item'>Carbs: $info->total_carbohydrate</li>";
            echo"</ul>";
        };
        
        $date = date("Y-m-d");
        echo $date;

        $form = <<<EOD
        <form class="form-inline" role="form" method="post" action="history.php">
            <div class="form-group">
                <label for="servings">Servings:</label>
                <input type="text" class="form-control" name="servings" placeholder="Enter servings">
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" class="form-control" name="date" value="$date">
            </div>
            <button type="submit" class="btn btn-default">Add to history </button>
            <input type="hidden" name="itemID" value="%s">
        </form>

EOD;
        $form = sprintf($form,$item_id);
        $this->setBodyFromCallable($lmd);
        $this->setBodyFromString($form);
    }
} 
