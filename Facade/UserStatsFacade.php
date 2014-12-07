<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/24/2014
 * Time: 2:05 PM
 */

namespace Facade;


class UserStatsFacade extends FacadeBase{
    public static function get_stats($user_id, $start_date='1970-01-01', $end_date='9999-12-31')
    {
        $start_time = $start_date.' 00:00:00';
        $end_time = $end_date.' 23:59:59';
        $ach = self::simple_exec("SELECT COUNT(*) AS num FROM achievementLog a
                                WHERE a.userID = '$user_id' AND a.Time>='$start_time'
                                AND a.Time<='$end_time'");
        //print_r($ach);
        $avg = self::simple_exec("SELECT AVG(d.cals) as avg FROM
                                (SELECT SUM(nd.calories*ih.servings) as cals, ih.historyDate as week
                                FROM itemhistory ih INNER JOIN nutritiondata nd ON nd.itemID = ih.itemID
                                WHERE userID = '$user_id' AND ih.historyDate>='$start_date'
                                AND ih.historyDate<='$end_date'
                                GROUP BY ih.historyDate) d");

        $us = new UserStats();
        $us->UserID = $user_id;
        $us->AwardsNum = count($ach) > 0 ? $ach[0]['num'] : 0;
        $us->CaloriesPerDay = count($avg) > 0 ? $avg[0]['avg'] : 0;
        $us->StartDate = $start_date;
        $us->EndDate = $end_date;

        return $us;
    }
} 