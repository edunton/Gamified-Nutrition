// <?php
try {
	$results = $db->query("SELECT caloryGoal FROM userProfiles");
	$totalCalory = $db -> query("SELECT sum(calories) as caloriesSum from userHistory");
} catch(Exception $e){
	echo "Data could not be retrieved";
	exit;
}

// echo "<pre>";
$caloryGoalRow = $results->fetchAll(PDO::FETCH_ASSOC); //calory goal of current user
// var_dump($row[0]["caloryGoal"]);

$calorySumResult = $totalCalory ->fetchAll(PDO::FETCH_ASSOC);//calorySum of current user
// var_dump($calorySumResult);


//users calory goal
$caloryGoal = $caloryGoalRow[0]["caloryGoal"];
// echo($caloryGoal);

//users current calories
$calorySum = $calorySumResult[0]["caloriesSum"];
// echo($calorySum);

// echo($caloryGoal - $calorySum);
$caloryDifference = $caloryGoal - $calorySum;
// echo($caloryDifference);


$caloryMessage = "";
if ($caloryDifference > 0){
	$caloryMessage = "You can eat more";
} else if ($caloryDifference == 0){
	$caloryMessage = "You reached your target today! Congratulations!";

} else {
	$caloryMessage = "You ate " .$caloryDifference. " too many calories!";
	// $caloryMessage = $caloryDifference;
}

echo($caloryMessage);

