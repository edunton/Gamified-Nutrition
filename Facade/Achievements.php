<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/20/2014
 * Time: 5:44 PM
 */

namespace Facade;

class Achievements extends LockableContainer{
    protected function fields()
    {
        return array(
            'AchievementID',
            'UserID',
            'AchievementType',
            'Date',
            'Progress'
        );
    }

} 