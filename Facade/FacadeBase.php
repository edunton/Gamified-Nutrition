<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/20/2014
 * Time: 10:01 AM
 */

namespace Facade;
use \Data\SQL\database as DB;

abstract class FacadeBase {
    protected static function simple_exec($sql, $fetch = true)
    {
        $db = new DB();
        $pdo = $db->PDO();
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        if($fetch)
        {
            $p = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $p;
        }
        return true;
    }

    protected static function gen_random($seed = null)
    {
        if($seed != null) return md5($seed);
        else return md5(time());
    }
} 