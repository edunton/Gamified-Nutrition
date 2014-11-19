<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/12/2014
 * Time: 8:46 AM
 */

namespace Display;

use Facade\UserProfileFacade as UPF;

class LoginPage extends Page{
    public function __construct()
    {
        if(count($_POST) > 0 && isset($_POST['username']) && isset($_POST['password']))
        {
            $name = $_POST['username'];
            $pass = $_POST['password'];
            $correct = UPF::check_user_pass_combo( $name, $pass );
            if($correct)
            {
                $user = UPF::get_user_by_name($name);
                UPF::set_and_gen_cookie($user->UserID);
                $this->setUser($user->UserID);
                header("Location: index.php");
                die();
            }
            else{
                parent::__construct('Gamified Nutrition','Login Failed','try again');
            }
        }
        else
        {
            parent::__construct('Gamified Nutrition','Gamified Nutrition','Eat Healthier Now');
        }

        $page = <<<EOD
<div class="jumbotron">
  <h1>A Message to Eaters Everywhere</h1>
  <p>Start Eating Healthy Now!</p>
  <button class="btn btn-primary btn-lg" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">Sign In/Register</button>
  <br>
</div>
EOD;

        $this->setBodyFromString($page);
    }
} 