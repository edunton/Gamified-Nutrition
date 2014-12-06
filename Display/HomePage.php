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
            header('Location: '.SITE_ROOT.'login.php');
            die();
        }

        $bodySearch = <<<EOD
        <div class="container">
        <div class="row" >
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="text-center">
                        Search Engine</h4>
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
                    <h4 class="text-center">
                        History</h4>
                </div>
                <div class="panel-body text-center">
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
                    <h4 class="text-center">
                        Statistic</h4>
                </div>

EOD;
        $bodyAch = <<<EOD

            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="text-center">
                        Achievement</h4>
                </div>
                <div class="panel-body text-center">
                    <p class="lead">
                        <strong>Achi</strong></p>

            </div>
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

                echo '<div class="text-center alert alert-info" role="alert">No history so far!</div>';
            }
        };

        $stats = USF::get_stats($userID,$start_date=date('Y-m-d', strtotime('-7 days')),$end_date=date("Y-m-d"));

        $stalst = function () use (&$stats) {

            $offset = sizeof($stats);

            if ($offset !== 0) {
                echo'<ul class="list-group">';

                $tags = array('UserID: ','CaloriesPerDay: ','AwardsNum: ','StartDate: ','EndDate: ');
                $i = 0;
                foreach ($stats as $s) {
                    if ($i != 0) {
                        echo "<li class='list-group-item'>  $tags[$i]  $s  </li>";
                    }
                    $i = $i + 1;
                }

                echo '</ul>';


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


    }



}
