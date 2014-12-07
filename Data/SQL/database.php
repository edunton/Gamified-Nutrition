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

    public function userProgress($userID,$date)
    {
       // try {
            //$userID = 1;//changes according to user --> Change this to the current user
            $caloryTarget = $this->db->query("SELECT targetLimit FROM user_Targets WHERE userID = '$userID'");
            $caloryGoalRow = $caloryTarget->fetchAll(); //calory goal of current user

            //print_r($caloryGoalRow);
            //no goals set by user
            if(!isset($caloryGoalRow[0]["targetLimit"]))
            {
                return 'no goals';
            }

            $targetLimit = $caloryGoalRow[0]["targetLimit"];
            /*
            $dailyCaloryIntake = $this->db->query ("SELECT sum(nd.calories*ih.servings) as dailyCaloriesSum
                                                    FROM `itemhistory` ih INNER JOIN `nutritiondata` nd
                                                    ON nd.itemID = ih.itemID
                                                    WHERE userID = '$userID' AND historyDate = '$date'");
            $dailyCaloryIntakeResult = $dailyCaloryIntake->fetchAll();
            */
            $achievements = $this->db->query("SELECT a.Time as ttime FROM achievementLog a
                                              WHERE a.userID = '$userID'
                                              ORDER BY a.Time DESC");
            $last_ach = $achievements->fetchAll();
            //print_r($dailyCaloryIntakeResult);

            //$dailyCaloryIntake = $dailyCaloryIntakeResult[0]["dailyCaloriesSum"];

            $timeobj1 = new \DateTime($date);
            $timeobj1->sub(new \DateInterval('P7D'));
            $timeobj2 = count($last_ach) > 0 ? new \DateTime($last_ach[0]['ttime']) : null;
            if($timeobj2 != null) $timeobj2->add(new \DateInterval('P1D'));

            //echo date('Y-m-d',$timeobj1->getTimestamp());
            //echo date('Y-m-d',$timeobj2->getTimestamp());

            if($timeobj2 != null)
            {
                $time_date = date('Y-m-d',max($timeobj1->getTimestamp(), $timeobj2->getTimestamp()));
            }
            else
            {
                $time_date = date('Y-m-d',$timeobj1->getTimestamp());
            }
            //echo $time_date;

            $totalCalory = $this->db->query("SELECT sum(nd.calories*ih.servings) as caloriesSum
                                            FROM `itemhistory` ih INNER JOIN `nutritiondata` nd
                                            ON nd.itemID = ih.itemID
                                            WHERE historyDate >= '$time_date' AND userID='$userID'
                                            GROUP BY historyDate");
            $calorySumResult = $totalCalory ->fetchAll();//calorySum of current user
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

        $successes = 0;
        foreach($calorySumResult as $sum)
        {
            if($sum['caloriesSum'] >= $lowerbound && $sum['caloriesSum'] <= $upperbound)
            {
                $successes++;
            }
            else
            {
                $successes = 0;
                break;
            }
        }

        //echo $successes;

        $randomID = md5(time());
        if($successes >= 7)
        {
            $writeAchievement = $this->db->query("INSERT INTO `gamifiedNutrition`.`achievementLog`
                            (`achievementLogID`, `userID`, `achievementType`, `Time`)
                            VALUES ('$randomID', '$userID', 'weeklyGoal', CURRENT_TIMESTAMP);");
            $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=0 WHERE userID = '$userID'");
        }
        else{
            $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=$successes WHERE userID = '$userID'");
        }
        /*
        $caloryMessage = "";

            if ($dailyCaloryIntake > $upperbound){
                $caloryMessage = "Over the upper bound";
                $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=0 WHERE userID = '$userID'");

            } else if ($lowerbound < $dailyCaloryIntake && $dailyCaloryIntake < $upperbound){
                $updateProgress = $this->db->query("UPDATE `userProgress` SET `progress`=`progress`+1 WHERE userID = '$userID'");
                $caloryMessage = "You're within the specified range";
                $progress = $this->db->query("SELECT progress FROM `userProgress` WHERE userID = '$userID'");
                $progressRow = $progress->fetchAll();

                //$progress = $progressRow[0]["progress"];
                if (count($progressRow) == 0 || $progressRow[0]["progress"] % 7 == 0){
                    $writeAchievement = $this->db->query("INSERT INTO `gamifiedNutrition`.`achievementLog`
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
        */
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




