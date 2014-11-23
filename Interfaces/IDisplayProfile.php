<?php namespace Interfaces;

/*
	Interface for Display Profile Page
	by Emily McCorry
*/

interface IDisplayProfile
{
	// displays nutrition goals
	public function DisplayGoals();
	// click editProfile to be directed to the Edit Profile page
	public function editProfile();

}