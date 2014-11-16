<?php namespace Interfaces;

/*
	Interface for Item Results Page
	by Emily McCorry
*/

interface IItemResults
{
	public function DisplayItems();
	public function SetServings($done);
	public function SetFinished($false);
	public function GoalAchieved($false);
	public function IncreasePoints($servings);

}