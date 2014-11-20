<?php namespace Facade;
/*
* Wrapper library of Nutritionix API
* by Eric Dunton
*/

use Interfaces\INutritionixFacade as INutritionixFacade;
use Data\Nutritionix as API;
use Data\SQL\database as DB;

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
        $add_to_db = false;
        $info = new ItemInfo();
        $db = new DB();
        $pdo = $db->PDO();
        $query = array();

        $stmt = $pdo->prepare("SELECT * FROM nutritionData where itemID = '".htmlspecialchars($item_id)."'");
        $thisID = htmlspecialchars($item_id);

        try{
            $stmt->execute();
            $query = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\Exception $err)
        {
            echo 'query failed ';
            echo $thisID;
            echo $err->getMessage();
            $query = array();
        }

        if(count($query) == 0){
            $infoAPI = $this->api->getItem($item_id,'id');
            //echo $item_id;
            //print_r($infoAPI);
            self::populate_from_api($info,$infoAPI);
            $insert =
                " INSERT INTO nutritionData (itemID,itemName,brandID,brandName,calories,caloriesFromFat,totalFat,
                  saturatedFat,transFattyAcid,cholesterol,sodium,totalCarbohydrate,dietaryFiber,servingSizeQty,
                  servingSizeUnit,servingWeightGrams)
                  VALUES (:item_id,:item_name,:brand_id,:brand_name,:calories,:calories_from_fat,:total_fat,
                  :sat_fat,:trans_fat,:chol,:sodium,:carbs,:fiber,:qty,:unit,:grm)";
            $stmt = $pdo->prepare($insert);
            $stmt->bindParam(':item_id',$id,\PDO::PARAM_STR);
            $stmt->bindParam(':item_name',$item_name,\PDO::PARAM_STR);
            $stmt->bindParam(':brand_id',$brand_id,\PDO::PARAM_STR);
            $stmt->bindParam(':brand_name',$brand_name,\PDO::PARAM_STR);
            $stmt->bindParam(':calories',$calories,\PDO::PARAM_STR);
            $stmt->bindParam(':calories_from_fat',$calories_from_fat,\PDO::PARAM_STR);
            $stmt->bindParam(':total_fat',$total_fat,\PDO::PARAM_STR);
            $stmt->bindParam(':sat_fat',$sat_fat,\PDO::PARAM_STR);
            $stmt->bindParam(':trans_fat',$trans_fat,\PDO::PARAM_STR);
            $stmt->bindParam(':chol',$chol,\PDO::PARAM_STR);
            $stmt->bindParam(':sodium',$sodium,\PDO::PARAM_STR);
            $stmt->bindParam(':carbs',$carbs,\PDO::PARAM_STR);
            $stmt->bindParam(':fiber',$fiber,\PDO::PARAM_STR);
            $stmt->bindParam(':qty',$qty,\PDO::PARAM_STR);
            $stmt->bindParam(':unit',$unit,\PDO::PARAM_STR);
            $stmt->bindParam(':grm',$grm,\PDO::PARAM_STR);

            $id = $info->item_id;
            $item_name = $info->item_name;
            $brand_name = $info->brand_name;
            $brand_id = $info->brand_id;
            $calories = $info->calories;
            $calories_from_fat = $info->calories_from_fat;
            $total_fat = $info->total_fat;
            $sat_fat = $info->saturated_fat;
            $trans_fat = $info->trans_fatty_acid;
            $chol = $info->cholesterol;
            $sodium = $info->sodium;
            $carbs = $info->total_carbohydrate;
            $fiber = $info->dietary_fiber;
            $qty = $info->serving_size_qty;
            $unit = $info->serving_size_unit;
            $grm = $info->serving_weight_grams;

            $stmt->execute();
        }
        else if (count($query) > 0){
            //print_r($query);
            self::populate_from_cache($info,$query[0]);
        }
        return $info;
    }

    private static function populate_from_cache(ItemInfo $info,$cache)
    {
        //$info->old_id = $cache['oldAPIID'];
        $info->item_id = $cache['itemID'];
        $info->item_name = $cache['itemName'];
        $info->brand_id = $cache['brandID'];
        $info->brand_name = $cache['brandName'];
        $info->item_description = $info->get_blank();
        $info->updated_at = $info->get_blank();
        $info->ingredient_statement = $info->get_blank();
        $info->water_grams = $info->get_blank();
        $info->calories = $cache['calories'];
        $info->calories_from_fat = $cache['caloriesFromFat'];
        $info->total_fat = $cache['totalFat'];
        $info->saturated_fat = $cache['saturatedFat'];
        $info->trans_fatty_acid = $cache['transFattyAcid'];
        $info->polyunsaturated_fat = $cache['polyunsaturatedFat'];
        $info->monounsaturated_fat = $cache['monounsaturatedFat'];
        $info->cholesterol = $cache['cholesterol'];
        $info->sodium = $cache['sodium'];
        $info->total_carbohydrate = $cache['totalCarbohydrate'];
        $info->dietary_fiber = $cache['dietaryFiber'];
        $info->sugars = $cache['sugars'];
        $info->protein = $cache['protein'];
        $info->vitaminA = $cache['vitaminA'];
        $info->vitaminC = $cache['vitaminC'];
        $info->calcium = $cache['calcium'];
        $info->iron = $cache['iron'];
        $info->refuse_pct = $cache['refusePct'];
        $info->servings_per_container = $cache['servingsPerContainer'];
        $info->serving_size_qty = $cache['servingSizeQty'];
        $info->serving_size_unit = $cache['servingSizeUnit'];
        $info->serving_weight_grams = $cache['servingWeightGrams'];
        $info->from_cache = 'hit';

        $info->lock();
    }

    private static function populate_from_api(ItemInfo $info,$api)
    {
        foreach($api as $key=>$value)
        {
            if(empty($value)) $api[$key] = $info->get_blank();
        }
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
        $info->total_fat = $api['nf_total_fat'];
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
        $info->refuse_pct = $api['nf_refuse_pct'];
        $info->servings_per_container = $api['nf_servings_per_container'];
        $info->serving_size_qty = $api['nf_serving_size_qty'];
        $info->serving_size_unit = $api['nf_serving_size_unit'];
        $info->serving_weight_grams = $info->get_blank();
        $info->from_cache = 'no hit';

        $info->lock();
    }
}



?>