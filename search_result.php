<?php
include 'nutritionix_wrapper.php';

if(count($_GET) > 0)
{
    $nut = get_nutritionix_object();
    $ar = $nut->getItem($_GET['item'],'id');
    echo '<pre>';
    print_r($ar);
    echo '</pre>';
}
?>