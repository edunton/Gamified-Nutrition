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

    public function userProgress($db)
    {
        try {
            $userID = $db->query("SELECT userID FROM userProfiles");
            $userIDObject = $userID->fetchAll();
            $userID = $userIDObject[0]["userID"];

            $caloryTarget = $db->query("SELECT targetLimit FROM user_Targets");
            $caloryGoalRow = $caloryTarget->fetchAll(); //calory goal of current user
            $targetLimit = $caloryGoalRow[0]["targetLimit"];

            $dailyCaloryIntake = $db->query ("SELECT sum(totalCalories) FROM `itemhistory` WHERE userID = 1 AND historyDate = DATE(NOW())");
            $dailyCaloryIntakeResult = $dailyCaloryIntake->fetchAll();

            $totalCalory = $db->query("SELECT sum(totalCalories) as caloriesSum from itemHistory WHERE historyDate > ADDDATE(NOW(), INTERVAL -1 WEEK) and userID=".$userID);
            $calorySumResult = $totalCalory ->fetchAll();//calorySum of current user
            $calorySum = $calorySumResult[0]["caloriesSum"];
        } 
        catch(Exception $e){
            echo "Data could not be retrieved";
            exit;
        }


        $caloryDifference = $targetLimit - $calorySum;

        $caloryMessage = "";
        if ($caloryDifference > 0){
            $caloryMessage = "You can eat more";
        } else if ($caloryDifference == 0){
            $caloryMessage = "You reached your target today! Congratulations!";

        } else {
            $caloryMessage = "You ate " .$caloryDifference. " too many calories!";
        }

        return $caloryMessage;
        
        // $writeMessage = $db->query("INSERT INTO `gamifiedNutrition`.`userProgress` (`userProgressID`, `userID`, `message`, `date`) VALUES (NULL, '$userID', '$caloryMessage', CURRENT_TIMESTAMP);");

    }

    public function PDO()
    {
        return $this->db;
    }
    
} 



