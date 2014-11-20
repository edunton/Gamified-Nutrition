<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/19/2014
 * Time: 10:13 AM
 */

namespace Facade;


class UserHistory extends LockableContainer{
    function __construct()
    {
        parent::__construct(0);
    }

    protected function fields()
    {
        return array(
            'historyID',
            'itemID',
            'userID',
            'servings',
            'historyDate',
            'lastEditDate'
        );
    }

} 