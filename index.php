<?php

require_once 'Main.php';

use \Display\Page as Page;
use \Display\SearchBar as SB;
use \Facade\NutritionixFacade as API;

$resultNum = 0;
$nutritionix = NULL;
$results = NULL;
$item = '';
$brand = '';
$offset = 0;
$redirect = "prototype".DIRECTORY_SEPARATOR."search_result.php"; //global defining redirect to link
$thispage = 'index.php';

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
                    echo '<div class="row" id="table_titles"><div class="col-md-3">Item Name</div>'
                        .'<div class="col-md-3">Brand</div></div>';
                    foreach ($results as $r){
                        echo '<a href="'.$redirect.'?item='.$r['item_id'].'">';
                        echo '<div class="row">';
                        foreach ($r as $key => $value) {
                            if ($key != 'item_id'){
                                echo '<div class="col-md-3">';
                                echo $value;
                                echo '</div>';
                            }
                        }
                        echo '</div>';
                        echo '</a>';
                    }
                    echo '<div class="row">';
                    if($offset >= 10)
                        echo '<div class="col-md-1">'
                            .'<form action="'.$thispage.'" method="post">'
                            .'<input type="hidden" name="offset" value='.(string)($offset - 10).'>'
                            .'<input type="hidden" name="item" value='.$item.'>'
                            .'<input type="hidden" name="brand" value='.$brand.'>'
                            .'<input type="submit" value="View Prev 10">'
                            .'</form>'
                            .'</div>';
                    if($offset + 10 < $resultNum)
                        echo '<div class="col-md-1">'
                            .'<form action="'.$thispage.'" method="post">'
                            .'<input type="hidden" name="offset" value='.(string)($offset + 10).'>'
                            .'<input type="hidden" name="item" value='.$item.'>'
                            .'<input type="hidden" name="brand" value='.$brand.'>'
                            .'<input type="submit" value="View Next 10">'
                            .'</form>'
                            .'</div>';
                    echo '</div>';
                }
                else if ($results != NULL) 
                    echo '<div class="error">Invalid Search</div>';
                echo "<div>Total: $resultNum</div>";
           };     

$page = new Page('title');
$sb = new SB('index.php');
$sbstr = $sb->display(NULL,NULL,$item,$brand);

$mybody = <<<EOD
<h1>Type some html into a string</h1>
<p>and it will produce a body</p>
EOD;

//$page->setBodyFromString($mybody);
$page->setBodyFromString($sbstr);
$page->setBodyFromCallable($lst);

echo $page->getPage();
?>