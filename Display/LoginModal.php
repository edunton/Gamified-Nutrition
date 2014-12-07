<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/12/2014
 * Time: 8:50 AM
 */

namespace Display;


use Interfaces\StaticFixture;

class LoginModal implements StaticFixture{
    public static function display($login = '#',$signup = '#'){

        return <<<EOD
<div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
<div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Login/Register for Gamified Nutrition</h4>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-6">
                      <div class="well">
                          <form id="loginForm" method="POST" action="$login" novalidate="novalidate">
                              <div class="form-group">
                                  <label for="username" class="control-label">Username</label>
                                  <input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="example">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                  <span class="help-block"></span>
                              </div>
                              <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                              <button type="submit" class="btn btn-success btn-block">Login</button>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <p class="lead">Register now for <span class="text-success">FREE</span></p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="fa fa-check text-success"></span> Keep track of your daily nutrition</li>
                          <li><span class="fa fa-check text-success"></span> Set goals to meet your</li>
                          <li><span class="fa fa-check text-success"></span> Get rewarded for your goals</li>
                          <li><a href="#"><u>Read more</u></a></li>
                      </ul>
                      <p><a href="$signup" class="btn btn-info btn-block">Yes please, register now!</a></p>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
EOD;


    }
} 