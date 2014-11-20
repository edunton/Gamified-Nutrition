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

    public function userProgress()
    {
        try {
            $results = $db->query("SELECT caloryGoal FROM userProfiles");
            $totalCalory = $db -> query("SELECT sum(calories) as caloriesSum from userHistory");
        } 
        catch(Exception $e){
            echo "Data could not be retrieved";
            exit;
        }

        $caloryGoalRow = $results->fetchAll(PDO::FETCH_ASSOC); //calory goal of current user
        $calorySumResult = $totalCalory ->fetchAll(PDO::FETCH_ASSOC);//calorySum of current user

        $caloryGoal = $caloryGoalRow[0]["caloryGoal"];
        $calorySum = $calorySumResult[0]["caloriesSum"];

        $caloryDifference = $caloryGoal - $calorySum;

        $caloryMessage = "";
        if ($caloryDifference > 0){
            $caloryMessage = "You can eat more";
        } else if ($caloryDifference == 0){
            $caloryMessage = "You reached your target today! Congratulations!";

        } else {
            $caloryMessage = "You ate " .$caloryDifference. " too many calories!";
        }
        return $caloryMessage;

    }

    public function PDO()
    {
        return $this->db;
    }
    
} 




