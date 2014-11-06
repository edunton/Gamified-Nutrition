<?php
require 'config.php';

try {
	$db = new PDO("mysql:host=localhost; dbname = gamifiedNutrition; port=8889","root");
	// $db = new PDO("mysql:host= " DB_HOST; "dbname = " DB_NAME;,"DB_USER");

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
	$db->exec("USE gamifiedNutrition");
	echo "successful connection";

} catch (Exception $e) {
	echo "Could not connect to the database";
	exit;
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


