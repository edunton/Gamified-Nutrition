<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/20/2014
 * Time: 10:31 PM
 */

namespace Facade;


class UserStats extends LockableContainer{
    protected function fields()
    {
        return array(
            'UserID',
            'CaloriesPerDay',
            'AwardsNum'
        );
    }
} 