<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/13/2014
 * Time: 10:43 PM
 */

namespace Display;
use Facade\UserProfileFacade as UPF;

class SignUpPage extends Page{
    public function __construct($designation)
    {
        $error_name = '';
        $name_class = 'form-group';
        $error_pass = '';
        $pass_class = 'form-group';
        $success = false;
        $name = '';
        $scripts = array('scripts'=>array('scripts/registration.js'));
        if(count($_POST) > 0)
        {
            if(isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['username']))
            {
                $name  = htmlspecialchars($_POST['username']);
                $pass1 = htmlspecialchars($_POST['pass1']);
                $pass2 = htmlspecialchars($_POST['pass2']);
                $aval = UPF::is_available_user_name($name);
                if($aval && $pass1 == $pass2)
                {
                    UPF::save_user_password($name,$pass1);
                    $user = UPF::get_user_by_name($name);
                    UPF::set_and_gen_cookie($user->UserID);
                    $success = true;
                    $this->setUser($user->UserID);
                    parent::__construct('Sign Up Successful','Sign Up Successful','start using now',$scripts);
                }
                else if(!$aval)
                {
                    $error_name = '*Username not available';
                    $name_class = 'form-group has-error';
                    parent::__construct('Sign Up Successful','Whoops','');
                }
                else if($pass1 != $pass2)
                {
                    $error_pass = '*Password fields do not match';
                    $pass_class = 'form-group has-error';
                    parent::__construct('Sign Up for Gamified Nutrition','Whoops','',$scripts);
                }
            }
            else parent::__construct('Sign Up for Gamified Nutrition','Register','for free',$scripts);
        }
        else parent::__construct('Sign Up for Gamified Nutrition','Register','for free',$scripts);

        $body = <<<EOD
    <form class="form-horizontal" role="form" method="post">
        <div class="$name_class">
          <label class="control-label col-sm-2" for="email">New Username: $error_name</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required="">
          </div>
        </div>
        <div class="$pass_class">
          <label class="control-label col-sm-2" for="pwd">Password: $error_pass</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="pwd" name="pass1" placeholder="Enter password" required="">
          </div>
        </div>
        <div class="$pass_class">
          <label class="control-label col-sm-2" for="pwd">Reenter Password: $error_pass</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="pwd2" name="pass2" placeholder="Enter password" required="">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button id="register" class="btn btn-default">Submit</button>
          </div>
        </div>
      </form>
EOD;
        if($success)
            $body = "<p>Success as $name</p>";
        $this->setBodyFromString($body);
    }
} 