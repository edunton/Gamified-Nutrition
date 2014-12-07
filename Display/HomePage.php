<?php
/**
 * Created by PhpStorm.
 * User: Sida Gao
 * Date: 12/4/2014
 * Time: 3:40 PM
 */

namespace Display;

use Facade\AchievementsFacade as AF;
use Facade\UserHistoryFacade as UHF;
use Facade\UserStatsFacade as USF;

class HomePage extends Page
{
    public function __construct()
    {
        parent::__construct('HomePage', 'HomePage', '');
        $item = '';
        $brand = '';

        $userID = $this->getUser();

        if ($userID == null){
            header('Location: /Gamified_Nutrition/login.php');
            die();
        }

        $bodySearch = <<<EOD
        <div class="container">
        <div class="row" >
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                        <h4 class="text-center"><a href="/Gamified-Nutrition/search.php"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span>Search Engine</a></h4>
                </div>

                <div class="panel-body text-center">
                    <p class="lead">
                        <strong>You can search more stuff here!</p>
                </div>

EOD;

        $bodyHistory = <<<EOD

        </div>
        </div>

        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">

                    <h4 class="text-center"><a href="/Gamified-Nutrition/history.php"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span>History</a></h4>

                </div>

EOD;

        $bodyStat = <<<EOD
            </div>
        </div>

        </div>
        <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">

                <h4 class="text-center"><a href="/Gamified-Nutrition/statistic.php"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>Statistic</a></h4>

                </div>

EOD;
        $bodyAch = <<<EOD

            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="text-center"><a href="/Gamified-Nutrition/achievement.php"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>Achievement</a></h4>
                </div>
EOD;


        $bodytail = <<<EOD

        </div>
        </div>
    </div>
</div>
EOD;


        $history = UHF::get_history_by_user($userID);


        $lst = function () use (&$history) {

            $offset = sizeof($history);

            if ($offset !== 0) {

                echo '<div class="table-responsive"><table class="table table-striped table-bordered"><thead><tr><th>Name</th><th>Total Calories</th><th>Date</th></tr></thead><tbody>';

                for ($i = 0; $i < $offset && $i < 5; $i++) {
                    echo '<tr><td>' . $history[$i]->itemName . '</td><td>' . $history[$i]->calories .'</td><td>' . $history[$i]->historyDate . '</td></tr>';
                }

                echo '</table></div>';
            } else {

                echo '<div class="alert alert-info" role="alert">No history so far!</div>';
            }
        };

        $stats = USF::get_stats($userID,$start_date=date('Y-m-d', strtotime('-7 days')),$end_date=date("Y-m-d"));

        $stalst = function () use (&$stats) {

            $offset = sizeof($stats);

            if ($offset != 0 && !is_null($stats->CaloriesPerDay)) {

                echo '<ul class="list-group text-center">';

                $tags = array('UserID: ', 'CaloriesPerDay: ', 'AwardsNum: ', 'StartDate: ', 'EndDate: ');
                $i = 0;
                foreach ($stats as $s) {
                    if ($i != 0) {
                        echo "<li class='list-group-item'>  $tags[$i]  $s  </li>";
                    }
                    $i = $i + 1;
                }

                echo '</ul>';


            } else {
                $start_date = date('Y-m-d', strtotime('-7 days'));
                $end_date = date("Y-m-d");
                echo '<ul class="list-group text-center">';
                echo "<li class='list-group-item'>CaloriesPerDay: 0</li>";
                echo "<li class='list-group-item'>AwardsNum: 0</li>";
                echo "<li class='list-group-item'>StartDate: $start_date </li>";
                echo "<li class='list-group-item'>EndDate: $end_date </li>";
                echo '</ul>';

            }
        };

        $ach = AF::get_user_achievements_by_ID($userID);
        $achlst = function () use ($ach) {

            $offset = sizeof($ach);

            if ($offset !== 0) {

                echo '<div class="table-responsive"><table class="table table-striped table-bordered"><thead><tr><th>AchievementType</th><th>Date</th><th>Progress</th></tr></thead><tbody>';

                for ($i = 0; $i < $offset && $i < 5; $i++) {
                    $p = ($ach[$i]->Progress/7)/100;
                    echo '<tr><td>' . $ach[$i]->AchievementType . '</td><td>' . $ach[$i]->Date .'</td><td>' . $ach[$i]->Progress . '<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:' . $p . '%">' . $p .'%
  </div>
</div></td></tr>';
                }

                echo '</table></div>';
            } else {

                echo '<div class="alert alert-info" role="alert">No achievement so far!</div>';
            }
        };


        $this->setBodyFromString($bodySearch);
        $sb = new SearchBar('search.php');
        $sbstr = $sb->display(NULL, 'row', $item, $brand);
        $this->setBodyFromString($sbstr);
        $this->setBodyFromString($bodyHistory);
        $this->setBodyFromCallable($lst);
        $this->setBodyFromString($bodyStat);
        $this->setBodyFromCallable($stalst);
        $this->setBodyFromString($bodyAch);
        $this->setBodyFromCallable($achlst);
        $this->setBodyFromString($bodytail);


    }



}
