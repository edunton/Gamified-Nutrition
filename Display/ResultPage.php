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
        parent::__construct($info->item_name,$info->item_name,$info->brand_name);
        $lmd = function() use ($info)
        {
            echo '<pre>';
            print_r($info);
            echo '</pre>';
        };
        $this->setBodyFromCallable($lmd);
    }
} 