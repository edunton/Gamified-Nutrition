<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/20/2014
 * Time: 9:54 AM
 */

namespace Facade;

use \Interfaces\IUserHistoryFacade;

class UserHistoryFacade extends FacadeBase implements IUserHistoryFacade{

    //allow for a user to enter new item and integer of servings eaten
    //date needs to be entered in Y-m-d format
    public static function enter_history_item($userID, $itemID, $servings, $historyDate)
    {
        if (\DateTime::createFromFormat('Y-m-d', $historyDate) == FALSE) {
            throw new \Exception('Facade Error: date not in Y-m-d format');
        }
        if(!is_int($servings) || $servings < 1)
            throw new \Exception('Facade Error: servings not positive integer');

        $historyID = self::gen_random();
        self::simple_exec("INSERT INTO itemhistory (historyID, itemID, userID, servings, historyDate)
                            VALUES ('$historyID','$itemID','$userID',$servings,'$historyDate')", false);
    }

    //Edits servings in row and date optionally
    public static function edit_servings_history($historyID, $new_servings, $new_date=null)
    {
        if(!is_int($new_servings) || $new_servings < 1)
            throw new \Exception('Facade Error: servings not positive integer');
        $set_date = '';
        if($new_date != null) {
            if (\DateTime::createFromFormat('Y-m-d', $new_date) == FALSE) {
                throw new \Exception('Facade Error: date not in Y-m-d format');
            }
            $set_date = "historyDate='$new_date',";
            echo $set_date;
        }
        self::simple_exec("UPDATE itemhistory SET $set_date servings=$new_servings
                            WHERE historyID='$historyID'",false);
    }

    //deletes a history item form the row
    public static function delete_history_item($historyID)
    {
        self::simple_exec("DELETE FROM itemhistory WHERE historyID='$historyID'",false);
    }

    //get user history as array of UserHistory objects, optional start date and end date arguments
    public static function get_history_by_user($userID, $start_date='1970-01-01', $end_date='9999-12-31')
    {
        $items = self::simple_exec("SELECT * FROM itemhistory
                                    WHERE userID='$userID' AND historyDate>='$start_date'
                                    AND historyDate<='$end_date'");
        $retArr = array();
        $nf = new NutritionixFacade();
        foreach($items as $item)
        {
            $history = new UserHistory();
            $history->historyID = $item['historyID'];
            $history->itemID= $item['itemID'];
            $history->userID = $item['userID'];
            $history->servings= $item['servings'];
            $history->historyDate= $item['historyDate'];
            $history->lastEditDate= $item['lastEditDate'];

            $info = $nf->getItem($history->itemID);

            $history->calories= $info->calories * $item['servings'];
            $history->itemName= $info->item_name;
            $history->brandName= $info->brand_name;
            $history->lock();

            array_push($retArr, $history);
        }

        return $retArr;
    }
} 