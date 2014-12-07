<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/20/2014
 * Time: 11:10 PM
 */

namespace Facade;


class AchievementsFacade extends FacadeBase{
    public static function get_user_achievements_by_ID($userID)
    {
        $prog = self::simple_exec("SELECT * FROM userprogress WHERE userID='$userID'");
        $achs = self::simple_exec("SELECT * FROM achievementLog WHERE userID='$userID'");

        $ret = array();
        foreach($prog as $p)
        {
            $info = new Achievements();
            $info->AchievementID = $p['userProgressID'];
            $info->UserID = $p['userID'];
            $info->AchievementType = 'In Progress';
            $info->Date = date('Y-m-d',time());

            $info->Progress = $p['progress'];
            $info->lock();

            array_push($ret,$info);
        }

        foreach($achs as $a)
        {
            $info = new Achievements();
            $info->AchievementID = $a['achievementLogID'];
            $info->UserID = $a['userID'];
            $info->AchievementType = $a['achievementType'];
            $info->Date = $a['Time'];
            $info->Progress = 7;

            $info->lock();

            array_push($ret,$info);
        }

        return $ret;
    }

} 