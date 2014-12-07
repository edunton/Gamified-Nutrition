<?php
/**
 * Created by PhpStorm.
 * User: Sida Gao
 * Date: 12/6/2014
 * Time: 1:02 PM
 */

namespace Display;

use Facade\AchievementsFacade as AF;
use Facade\UserHistoryFacade as UHF;
use Facade\UserStatsFacade as USF;
use Facade\UserProfileFacade as UPF;

class ProfileEdit extends Page {


    public function __construct()
    {
        parent::__construct('Profile Edit Page', 'Profile Edit Page', '');

        $userID = $this->getUser();
        $confirmation = false;


        if (is_null($userID)){
            header('Location: '.SITE_ROOT.'login.php');
            die();
        }

        if (count($_POST) > 0) {

            $goal = $_POST["goal"];

            UPF::set_user_calories_goal($userID,$goal);
            UPF::set_and_gen_cookie($userID);
            $confirmation = true;

        }

        $info = UPF::get_user_by_id($userID);
        $caloriesgoal = $info->CalorieGoal;

        $msg = <<<EOD
                    <div class="text-center alert alert-success col-sm-offset-1 col-sm-10" role="alert">
                    <p>Congratulations! You have successfully edited your calories goal!</br>Current Calories Goal: $caloriesgoal.</p></br>
                    <p>Redirect to Homepage in 3 seconds<p>

                    <div>
EOD;

        $form = <<<EOD
        <form class="form-horizontal" role="form" method="post" action="ProfileEdit.php">
            <div class="form-group">
            <label class="control-label col-sm-2" for="goal">New Calories Goal:</label>
            <div class="col-sm-10">
            <input type="number" class="form-control" name="goal" placeholder="Your current Calories Goal: $caloriesgoal ">
            </div>
            </div>
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Update!</button>
        </div>
        </div>
        </form>
EOD;

        if ($confirmation) {
                $this->setBodyFromString($msg);
                $this->setBodyFromString($form);
                header( "refresh:3;url=/Gamified-Nutrition/homepage.php" );
            }
        else {
                $this->setBodyFromString($form);
            }
        }




    }


