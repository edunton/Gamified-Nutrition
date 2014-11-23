<?php namespace Interfaces;

/*
	Interface for Database
	by Emily McCorry
*/

interface IDatabase
{
	// query the page
	public function QueryPage($page);
	// returns the statistics for the user
	public function GetStats($user);
	// changes the username in the database
	public function ChangeUsername($newName);
	// changes the password in the database
	public function ChangePassword($newPass);
	// changes the goals in the database
	public function ChangeGoals($newGoals);
	// gets the achievements from the database
	public function GetAchievements($user);
	// checks if the username exists
	public function CheckUsername($user);
	// saves new user and corresponding password
	public function SaveUserandPass($user, $pass);
	// saves new goals for the user
	public function SaveGoals($calories);
	// get the history of the user
	public function GetHistory($user);
	// query item
	public function QueryItem($item_id);
	// check to see if number of points is enough to get an achievement
	public function CheckNumPoints($points);

}