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

    public function userProgress($userID)
    {
       // try {
            //$userID = 1;//changes according to user --> Change this to the current user
            $caloryTarget = $this->db->query("SELECT targetLimit FROM user_Targets WHERE userID = '$userID'");
            $caloryGoalRow = $caloryTarget->fetchAll(); //calory goal of current user

            //no goals set by user
            if(!isset($caloryGoalRow[0]["targetLimit"]))
            {
                return 'no goals';
            }

            $targetLimit = $caloryGoalRow[0]["targetLimit"];

            $dailyCaloryIntake = $this->db->query ("SELECT sum(nd.calories) as dailyCaloriesSum
                                                    FROM `itemhistory` ih INNER JOIN `nutritiondata` nd
                                                    ON nd.itemID = ih.itemID
                                                    WHERE userID = '$userID' AND historyDate = DATE(NOW())");
            $dailyCaloryIntakeResult = $dailyCaloryIntake->fetchAll();
            $dailyCaloryIntake = $dailyCaloryIntakeResult[0]["dailyCaloriesSum"];

            $totalCalory = $this->db->query("SELECT sum(nd.calories) as caloriesSum
                                                    FROM `itemhistory` ih INNER JOIN `nutritiondata` nd
                                                    ON nd.itemID = ih.itemID
                                                WHERE historyDate > ADDDATE(NOW(), INTERVAL -1 WEEK) and userID='$userID'");
            $calorySumResult = $totalCalory ->fetchAll();//calorySum of current user
            $calorySum = $calorySumResult[0]["caloriesSum"];
       /* }
        catch(\Exception $e){
            echo "Data could not be retrieved";
            exit;
        }*/
        $upperbound = $targetLimit * 1.05;
        $lowerbound = $targetLimit * 0.90;
        // $caloryDifference = $targetLimit - $dailyCaloryIntake;
        // echo($caloryDifference);
        // echo($dailyCaloryIntake);

        $caloryMessage = "";
        $randomID = md5(time());

            if ($dailyCaloryIntake > $upperbound){
                $caloryMessage = "Over the upper bound";
                $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=0 WHERE userID = '$userID'");

            } else if ($lowerbound < $dailyCaloryIntake && $dailyCaloryIntake < $upperbound){
                $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=`progress`+1 WHERE userID = '$userID'");
                $caloryMessage = "You're within the specified range";
                $progress = $db->query("SELECT progress FROM `userProgress` WHERE userID = '$userID'");
                $progressRow = $progress->fetchAll();
                $progress = $progressRow[0]["progress"];
                if ($progress % 7 == 0){
                    $writeAchievement = $db->query("INSERT INTO `gamifiedNutrition`.`achievementLog`
                            (`achievementLogID`, `userID`, `achievementType`, `Time`)
                            VALUES ('$randomID', '$userID', 'weeklyGoal', CURRENT_TIMESTAMP);");
                }


            } else if ($dailyCaloryIntake < $lowerbound) {
                $caloryMessage = "You can eat more";
                $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=`progress`+1 WHERE userID = '$userID'");
                $progress = $this->db->query("SELECT progress FROM `userProgress` WHERE userID = '$userID'");
                $progressRow = $progress->fetchAll();
                $progress = count($progressRow) > 0 ? $progressRow[0]["progress"] : 1;
                if ($progress % 7 == 0){
                    $writeAchievement = $this->db->query("INSERT INTO `gamifiedNutrition`.`achievementLog`
                                                  (`achievementLogID`, `userID`, `achievementType`, `Time`)
                                                  VALUES ('$randomID', '$userID', 'weeklyGoal', CURRENT_TIMESTAMP);");
                }
            }

        return $caloryMessage; //just to test if the query works
        
    }

    public function averagePerDay($db)
    {
        $userID = 1; //change this accordingly
        $totalCalory = $db->query("SELECT sum(totalCalories) as caloriesSum from itemHistory WHERE userID = $userID");
        $calorySumResult = $totalCalory ->fetchAll();
        $totalCalory = $calorySumResult[0]["caloriesSum"];


        $numberOfEntries = $db->query("SELECT COUNT(*) as count FROM( SELECT DISTINCT historyDate FROM itemhistory WHERE userID = $userID) x");
        $entriesString = $numberOfEntries->fetchAll();
        $numberOfEntries = $entriesString[0]["count"];
        // echo($numberOfEntries);

        $averageCaloriesPerDay = $totalCalory / $numberOfEntries;
        echo($averageCaloriesPerDay);

        $insertAverageToTable = $db->query("UPDATE `averageCalories` SET `averageCaloriesPerDay`=$averageCaloriesPerDay WHERE userID = $userID");

    }

    public function PDO()
    {
        return $this->db;
    }
    
} 


// //testing userProgress()
// $database = new database();
// $db = $database->PDO();
// $test = $database->averagePerMeal($db);
// echo($test);




