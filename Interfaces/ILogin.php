<?php namespace Interfaces;

/*
	Interface for the Login Page
	by Emily McCorry
*/

interface ILogin
{
	// sets new username
	public function SetUsername($name);
	// sets new password
	public function SetPassword($pass);
	// sets the home page to be directed to
	public function SetHomePage($page);
	// display error if password and username don't match
	public function DisplayUnfoundPair();
	// display error if username or password isn't entered
	public function DisplayMissingArgument();

}