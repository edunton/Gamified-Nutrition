<?php
/**
 * Created by PhpStorm.
 * User: Sida Gao
 * Date: 12/7/2014
 * Time: 5:02 PM
 */

namespace Display;

use Facade\AchievementsFacade as AF;
use Facade\UserHistoryFacade as UHF;
use Facade\UserStatsFacade as USF;

class StatisticPage extends Page
{

    public function __construct()
    {

        parent::__construct('View Statistic', 'Statistic', '');


        $userID = $this->getUser();
        $stats = USF::get_stats($userID, $start_date = date('Y-m-d', strtotime('-35 days')), $end_date = date("Y-m-d"));


        $first = USF::get_stats($userID, $start_date =  date('Y-m-d', strtotime('-7 days')),$end_date = date("Y-m-d") );
        $second = USF::get_stats($userID, $start_date = date('Y-m-d', strtotime('-14 days')), $end_date = date('Y-m-d', strtotime('-7 days')));
        $third = USF::get_stats($userID, $start_date = date('Y-m-d', strtotime('-21 days')), $end_date = date('Y-m-d', strtotime('-14 days')));
        $fourth = USF::get_stats($userID, $start_date = date('Y-m-d', strtotime('-28 days')), $end_date = date('Y-m-d', strtotime('-21 days')));
        $fifth = USF::get_stats($userID, $start_date = date('Y-m-d', strtotime('-35 days')), $end_date = date('Y-m-d', strtotime('-28 days')));

        $c1 = ($first->CaloriesPerDay) * 7;
        $c2 = ($second->CaloriesPerDay) * 7;
        $c3 = ($third->CaloriesPerDay) * 7;
        $c4 = ($fourth->CaloriesPerDay) * 7;
        $c5 = ($fifth->CaloriesPerDay) * 7;

        $code = <<<EOD
<table class="table table-hover table-striped table-bordered"><thead class="text-center"><tr><th>Week</th><th>StartDate</th><th>EndDate</th><th>CaloriesPerDay</th><th>CaloriesPerWeek</th></tr></thead><tbody>
<tr><td>1</td><td>$first->StartDate</td><td>$first->EndDate</td><td>$first->CaloriesPerDay</td><td>$c1</td></tr>
<tr><td>2</td><td>$second->StartDate</td><td>$second->EndDate</td><td>$second->CaloriesPerDay</td><td>$c2</td></tr>
<tr><td>3</td><td>$third->StartDate</td><td>$third->EndDate</td><td>$third->CaloriesPerDay</td><td>$c3</td></tr>
<tr><td>4</td><td>$fourth->StartDate</td><td>$fourth->EndDate</td><td>$fourth->CaloriesPerDay</td><td>$c4</td></tr>
<tr><td>5</td><td>$fifth->StartDate</td><td>$fifth->EndDate</td><td>$fifth->CaloriesPerDay</td><td>$c5</td></tr>
</tbody>
EOD;


        $offset = sizeof($stats);

        if ($offset != 0 && !is_null($stats->CaloriesPerDay)) {

            $this->setBodyFromString($code);

        } else {



        }




    }


}
