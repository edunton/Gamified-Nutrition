<?php namespace Interfaces;

/*
	Interface for Set Goals Page
	by Emily McCorry
*/

interface ISetGoals
{
	// creates the goals for the user using the database
	public function CreateGoals();
	// generates error if the goals are invalid (calories per day are too high)
	public function DisplayInvalidGoals();
	// sets Home page to return to after created the profile
	public function SetHomePage($page);

}