<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/6/2014
 * Time: 7:19 PM
 */

namespace Display;

use \Facade\NutritionixFacade as API;

class SearchPage extends Page {

    public function __construct($file,$redirect)
    {
        parent::__construct('Search For Food','Search','');
        $resultNum = 0;
        $nutritionix = NULL;
        $results = NULL;
        $item = '';
        $brand = '';
        $offset = 0;
        //$redirect = "prototype".DIRECTORY_SEPARATOR."search_result.php"; //global defining redirect to link
        $thispage = $file;

        if(count($_POST) > 0)
        {
            $item = $_POST['item'];
            if (strlen($_POST['brand']) > 0 && strlen(trim($_POST['brand'])) != 0)
                $brand = $_POST['brand'];
            $offset = intval($_POST['offset']);
            $nutritionix = new API();
            $searched = $nutritionix->search($item,$brand,$offset);
            //print_r($searched);
            if(isset($searched['total'])) $resultNum = $searched['total'];
            if(isset($searched['hits'])) $results = $searched['hits'];
        }

        $lst = function() use (&$results,$redirect,$item,$brand,$offset,$resultNum,$thispage)
        {
            if ($results != NULL)
            {
                echo '<div class="list-group">';
                echo '<div class="list-group-item active"><div class="row" id="table_titles"><div class="col-md-4">Item Name</div>'
                    .'<div class="col-md-4">Brand</div></div></div>';
                foreach ($results as $r){
                    echo '<a href="'.$redirect.'?item='.$r['item_id'].'" class="list-group-item">';
                    echo '<div class="row">';
                    foreach ($r as $key => $value) {
                        if ($key != 'item_id'){
                            echo '<div class="col-md-4">';
                            echo $value;
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                    echo '</a>';
                }
                echo '</div>';
                echo '<div class="row">';
                if($offset >= 10)
                    echo '<div class="col-md-1">'
                        .'<form action="'.$thispage.'" method="post">'
                        .'<input type="hidden" name="offset" value='.(string)($offset - 10).'>'
                        .'<input type="hidden" name="item" value='.$item.'>'
                        .'<input type="hidden" name="brand" value='.$brand.'>'
                        .'<input class="btn btn-default" type="submit" value="<< Prev 10">'
                        .'</form>'
                        .'</div>';
                if($offset + 10 < $resultNum)
                    echo '<div class="col-md-1">'
                        .'<form action="'.$thispage.'" method="post">'
                        .'<input type="hidden" name="offset" value='.(string)($offset + 10).'>'
                        .'<input type="hidden" name="item" value='.$item.'>'
                        .'<input type="hidden" name="brand" value='.$brand.'>'
                        .'<input class="btn btn-default" type="submit" value="View Next 10 >>">'
                        .'</form>'
                        .'</div>';
                echo '</div>';
            }
            else if ($results != NULL)
                echo '<div class="error">Invalid Search</div>';
            echo '<div>Total: <span class="badge">'.$resultNum.'</span></div>';
        };

        //$page = new Page('title');
        $sb = new SearchBar($thispage);
        $sbstr = $sb->display(NULL,'row',$item,$brand);

        $this->setBodyFromString($sbstr);
        $this->setBodyFromCallable($lst);
    }
}