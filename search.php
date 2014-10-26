<?php 
include "nutritionix_wrapper.php";

$resultNum = 0;
$nutritionix = NULL;
$results = NULL;
$item = NULL;
$brand = NULL;
$offset = 0;
$redirect = "search_result.php"; //global defining redirect to link

if(count($_POST) > 0) {
    $item = $_POST['item'];
    if (strlen($_POST['brand']) > 0 && strlen(trim($_POST['brand'])) != 0)
        $brand = $_POST['brand'];
    $offset = intval($_POST['offset']);
    $nutritionix = get_nutritionix_object();
    $results = $nutritionix->search($item,$brand,$offset);
    if(property_exists($results, 'total'))
        $resultNum = $results->total;
}

?>
<html>
    <head>
        <title>Nutrition Search Prototype</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            <h1>Search</h1>
            <form action="search.php" method="post">
                <div class="row">
                    <div class="col-md-2">
                        Item: 
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="item" <?php if($item != NULL) echo 'value="'.$item.'"' ?>>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        Brand (optional):
                    </div>
                    <div class="col-md-2">
                       <input type="text" name="brand" <?php if($brand != NULL) echo 'value="'.$brand.'"' ?>> 
                    </div>
                </div> 
                <input type="hidden" name="offset" value="0">
                <br>
                <input type="submit" name="Search">
            </form>
            <div id="total">Number of results: <?php echo $resultNum; ?></div>
            <div id="results">
            <?php 
                if ($results != NULL && property_exists($results, 'hits'))
                {
                    echo '<div class="row" id="table_titles"><div class="col-md-3">Item Name</div>'
                        .'<div class="col-md-3">Brand</div></div>';
                    $res = array_map('get_results_from_hit', $results->hits);
                    foreach ($res as $r){
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
                            .'<form action="search.php" method="post">'
                            .'<input type="hidden" name="offset" value='.(string)($offset - 10).'>'
                            .'<input type="hidden" name="item" value='.$item.'>'
                            .'<input type="hidden" name="brand" value='.$brand.'>'
                            .'<input type="submit" value="View Prev 10">'
                            .'</form>'
                            .'</div>';
                    if($offset + 10 < $resultNum)
                        echo '<div class="col-md-1">'
                            .'<form action="search.php" method="post">'
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
                
            ?>
            </div>
        </div>
    </body>
</html>