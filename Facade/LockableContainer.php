<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/5/2014
 * Time: 11:12 PM
 *
 * Allows for information to be locked once it is entered
 */

namespace Facade;


abstract class LockableContainer extends Container
{
    private $locked = false;

    public function lock()
    {
        $this->locked = true;
    }

    protected function handle_set($name,$value)
    {
        if($this->locked) throw new \Exception('Cannot set item once Lockable Container is Locked');
        else return true;
    }
    protected function handle_get($name)
    {
        return true;
    }

    protected function alt_get($name)
    {
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    protected function handle_isset($name)
    {
        return true;
    }
    protected function handle_unset($name)
    {
        return false;
    }

    protected function alter_set($name)
    {
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        throw new \Exception("Property '$name' not defined in LockableContainer");
    }
    protected function alter_get($name)
    {
        //not implemented
    }
} 