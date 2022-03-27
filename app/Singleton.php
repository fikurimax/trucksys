<?php

namespace App;

class Singleton
{
    public static function getInstance()
    {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
    }

    protected function __construct()
    {
        // protect construct to prevent from creating a new object
    }

    private function __wakeup()
    {
        // private wakeup method to prevent from unserialization
    }

    private function __clone()
    {
        // private clone method to prevent from clonable
    }
}
