<?php
namespace Data\SQL;

class database
{
    private $db;
    public function __construct()
    {
        try
        {
            $this->db = new \PDO("mysql:host=localhost; dbname = gamifiedNutrition; port=3306", "root");
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->db->exec("SET NAMES 'utf8'");
            $this->db->exec("USE gamifiedNutrition");
        }
        catch
        (\Exception $e) {
            echo "Could not connect to the database";
            echo $e->getMessage();
            exit;
        }
    }

    public function PDO()
    {
        return $this->db;
    }
}

//Test a query
// try {
// 	$results = $db->query("SELECT itemID FROM nutritionData");
// } catch(Exception $e){
// 	echo "Data could not be retrieved";
// 	exit;
// }

// // echo "<pre>";
// $food = $results->fetchAll(PDO:: FETCH_ASSOC);
// var_dump($food);


