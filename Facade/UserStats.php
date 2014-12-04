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
            'AwardsNum',
            'StartDate',    //will be in Y-m-d format, 1970-01-01 if no start date specified
            'EndDate'       //9999-12-31 if no end date specified
        );
    }
} 