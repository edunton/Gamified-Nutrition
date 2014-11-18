<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/13/2014
 * Time: 3:47 PM
 */

namespace Interfaces;


interface IUserProfileFacade {
    public static function is_available_user_name($name);
    public static function save_user_password($name,$pass);
    public static function check_user_pass_combo($name,$pass);
    public static function get_user_by_name($name);
    public static function get_user_by_id($id);
    public static function get_user_by_cookie($cookie);
}