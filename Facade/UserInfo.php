<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/13/2014
 * Time: 3:51 PM
 */

namespace Facade;


class UserInfo extends LockableContainer{
    public function __construct(){
        parent::__construct('N/A');
    }

    protected function fields()
    {
        return array(
            'UserID',
            'UserName',
            'CalorieGoal',
            'FatGoal',
            'SodiumGoal'
        );
    }
} 