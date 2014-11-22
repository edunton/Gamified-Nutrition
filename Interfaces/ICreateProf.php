<?php namespace Interfaces;

/*
	Interface for Create Profile Page
	by Emily McCorry
*/

interface ICreateProf
{
	// create new username
	public function CreateUsername($user);
	// create new password
	public function CreatePassword($pass);
	// display error if password is invalid (doesn't match password requirements)
	public function DisplayInvalidPassword();
	// display error if the username already exists
	public function DisplayAlreadyExists();
	// set the new home page
	public function SetHomePage($page);

}