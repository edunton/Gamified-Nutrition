<?php namespace Interfaces;

/*
	Interface for the Edit Profile Page
	by Emily McCorry
*/

interface IEditProfile
{
	// calls Database to edit the username
	public function EditUsername($username);
	// calls Database to edit the password
	public function EditPassword($password);
	// calls Database to edit the Goals
	public function EditGoals($calorieGoals);

}