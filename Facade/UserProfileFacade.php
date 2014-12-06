<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/13/2014
 * Time: 5:28 PM
 */

namespace Facade;

use \Interfaces\IUserProfileFacade;
use \Data\SQL\database as DB;

class UserProfileFacade extends FacadeBase implements IUserProfileFacade{
    public static function is_available_user_name($name)
    {
        $db = new DB();
        $pdo = $db->PDO();
        $stmt = $pdo->prepare("SELECT userID FROM userprofiles where userName = '".htmlspecialchars($name)."'");
        $stmt->execute();
        $p = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return count($p) == 0;
    }

    public static function save_user_password($name, $pass)
    {
        $db = new DB();
        $pdo = $db->PDO();
        $stmt = $pdo->prepare("INSERT INTO userprofiles (userID, userName, password) VALUES (:id,:usern,:passhash)");
        $stmt->bindParam(':id',$id,\PDO::PARAM_STR);
        $stmt->bindParam(':usern',$usern,\PDO::PARAM_STR);
        $stmt->bindParam(':passhash',$passhash,\PDO::PARAM_STR);
        $id = md5( time( ) );
        $usern = htmlspecialchars($name);
        $passhash = password_hash($pass,PASSWORD_DEFAULT);
        $stmt->execute();
    }

    public static function check_user_pass_combo($name, $pass)
    {
        $db = new DB();
        $pdo = $db->PDO();
        $stmt = $pdo->prepare("SELECT password FROM userprofiles where userName = '".htmlspecialchars($name)."'");
        $stmt->execute();
        $p = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if(count($p) == 0 || !isset($p[0]['password'])) return false;
        return password_verify($pass,$p[0]['password']);
    }

    public static function get_user_by_name($name)
    {
        $db = new DB();
        $pdo = $db->PDO();
        $stmt = $pdo->prepare("SELECT * FROM userprofiles where userName = '".htmlspecialchars($name)."'");
        $stmt->execute();
        $p = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return self::construct_user($p);
    }

    public static function get_user_by_id($id)
    {
        $db = new DB();
        $pdo = $db->PDO();
        $stmt = $pdo->prepare("SELECT * FROM userprofiles where userID = '".htmlspecialchars($id)."'");
        $stmt->execute();
        $p = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return self::construct_user($p);
    }

    public static function set_user_calories_goal($userID,$goal)
    {
        $md = self::gen_random();
        self::simple_exec("UPDATE userprofiles SET caloryGoal=$goal WHERE userID='$userID';
                          DELETE FROM user_Targets WHERE userID='$userID';
                          INSERT INTO user_Targets (userID,typeID,targetLimit) VALUES ('$userID',1,'$goal');",false);
    }

    public static function get_user_by_cookie($cookie)
    {
        $p = self::simple_exec("SELECT up.userID AS userID, up.userName AS userName from userprofiles up
                              INNER JOIN usercookies uc on uc.userID = up.userID
                              WHERE uc.cookie = '".htmlspecialchars($cookie)."'");

        return self::construct_user($p);
    }

    public static function set_and_gen_cookie($id)
    {
        $cookie = md5( time( ) );
        $id = htmlspecialchars($id);
        self::simple_exec("INSERT INTO usercookies (cookie, userID) VALUES ('$cookie', '$id')",false);
        setcookie('user',$cookie);
    }

    private static function construct_user($p)
    {
        if(count($p) > 0)
        {
            //print_r($p);
            $uinfo = new UserInfo();
            if(isset($p[0]['userName'])) $uinfo->UserName = $p[0]['userName'];
            if(isset($p[0]['username'])) $uinfo->UserName = $p[0]['username'];
            if(isset($p[0]['userID'])) $uinfo->UserID = $p[0]['userID'];
            if(isset($p[0]['caloryGoal'])) $uinfo->CalorieGoal = $p[0]['caloryGoal'];
            $uinfo->lock();
            return $uinfo;
        }

        return false;
    }
} 