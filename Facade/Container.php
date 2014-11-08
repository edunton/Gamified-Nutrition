<?php
/**
 * Created by PhpStorm.
 * User: Eric
 * Date: 11/5/2014
 * Time: 10:57 PM
 *
 * Allows for the easy implementation of an iterable data container
 * to allow for restrictions on how its is set and accessed
 */

namespace Facade;


abstract class Container implements \Iterator{

    //returns an defining object's fields
    abstract protected function fields();
    //returns true for default action, false to go to alter_set
    abstract protected function handle_set($name,$value);
    //returns alternate value for called-upon field
    abstract protected function alter_set($name,$value);
    //returns true for default action, false to go to alter_get
    abstract protected function handle_get($name);
    //returns true for default action, false to go to alter_set
    abstract protected function alter_get($name);
    //controls if isset property can be accessed
    abstract protected function handle_isset($name);
    //controls if isset property can be accessed
    abstract protected function handle_unset($name);

    protected $data = array();
    protected $keys;
    private $position = 0;
    private $blank;

    public function __construct($blank_val = null)
    {
        $fs = $this->fields();
        $this->blank = $blank_val;
        foreach($fs as $f)
        {
            $this->data[$f] = $blank_val;
        }
        $this->keys = array_keys($this->data);
    }

    public function get_blank()
    {
        return $this->blank;
    }

    public function __set($name, $value)
    {
        if(!array_key_exists($name, $this->data))
            throw new \Exception('Cannot set value "'.$name.'" not in the fields');
        else if ($this->handle_set($name,$value)){
            if($value == null) $this->data[$name] = $this->blank;
            else $this->data[$name] = $value;
        }
        else
            $this->data[$name] = $this->alter_set($name,$value);
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data) && $this->handle_get($name)) {
            return $this->data[$name];
        }
        return $this->alter_get($name);
    }

    public function __isset($name)
    {
        if($this->handle_isset($name))
            return isset($this->data[$name]);
    }

    public function __unset($name)
    {
        if ($this->handle_unset($name))
            unset($this->data[$name]);
    }

    // Allows for iteration over fields and their values
    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->data[$this->keys[$this->position]];
    }

    function key() {
        return $this->keys[$this->position];
    }

    function next() {
        $this->position += 1;
    }

    function valid() {
        if($this->position < count($this->keys))
            return isset($this->data[$this->keys[$this->position]]);
        return false;
    }
} 