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
        $achs = self::simple_exec("SELECT * FROM achievementLog WHERE userID='$userID'");

        $ret = array();
        foreach($achs as $a)
        {
            $info = new Achievements();
            $info->AchievementID = $a['achievementLogID'];
            $info->UserID = $a['userID'];
            $info->AchievementType = $a['achievementType'];
            $info->Date = $a['Time'];

            $info->lock();

            array_push($ret,$info);
        }

        return $ret;
    }

} 