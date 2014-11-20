<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/19/2014
 * Time: 9:46 AM
 */

namespace Interfaces;


interface IUserHistoryFacade {
    public static function enter_history_item($userID, $itemID, $servings ,$historyDate);
    public static function edit_servings_history($historyID,$new_servings,$new_date);
    public static function delete_history_item($historyID);

    //returns array of UserHistory objects
    public static function get_history_by_user($userID,$start_date,$end_date);
} 