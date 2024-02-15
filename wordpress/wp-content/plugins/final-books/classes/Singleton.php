<?php

namespace BookPlugin;

abstract class Singleton
{
    protected static $instance;

    //private constructor
   abstract protected function __construct();

    private function __clone(){

    }
    //method that will create or return the existing instance

    /**
     * @return mixed
     */
    public static function getInstance() {
        if(static::$instance ==null){
            static::$instance= new static();
        }
        return static:: $instance;
    }
}