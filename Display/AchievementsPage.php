<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 12/6/2014
 * Time: 2:34 PM
 */

namespace Display;
use Facade\AchievementsFacade as AF;
use Facade\UserProfileFacade as UPF;

class AchievementsPage extends Page{

    function __construct()
    {
        if(isset($_COOKIE['user'])) {
            $user = UPF::get_user_by_cookie($_COOKIE['user']);
            if ($user) {
                parent::__construct('Achievements',$user->UserName.'\'s Achievements', '');
            }
            else{
                header('Location '.SITE_ROOT.'/login.php');
                die();
            }
        }
        else{
            header('Location '.SITE_ROOT.'/login.php');
            die();
        }

        $lst = function() {
            $history = AF::get_user_achievements_by_ID($this->getUser());
            $offset = sizeof($history);

            if ($offset !== 0) {

                echo '<div class="table-responsive"><table class="table table-striped table-bordered">
                <thead><tr><th>Name</th><th>Brand</th>><th>Servings</th><th>Total Calories</th><th>Date</th></tr></thead><tbody>';

                for ($i = 0; $i < $offset; $i++) {
                    echo '<tr><td>' . $history[$i]->AchievementType . '</td><td>' . $history[$i]->Date
                        . '</td><td>' . $history[$i]->Progress . '</td></tr>';
                }

            } else {

                echo '<div class="alert alert-info" role="alert">No Achievements yet!</div>';
            }
        };

        $this->setBodyFromCallable($lst);
    }
} 