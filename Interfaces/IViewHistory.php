<?php namespace Interfaces;

/*
	Interface for View History Page
	by Emily McCorry
*/

interface IViewHistory
{
	// display if there is not history for user
	public function DisplayNoHistory();
	// display history for the user
	public function DisplayHistory();

}