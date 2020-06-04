<?php

# Class to load php configuration files

class ConfigClass
{

    # All of the items from the config file that is loaded
    public static $items = array();

     # Loads the config file specified and sets $items to the array
    public static function load( $filepath)
    {
        static::$items = include(  dirname( dirname(__FILE__)).'/config/' . $filepath . '.php');
    }

    # Searches the $items array and returns the item
    public static function get($key = null)
    {
        $input = explode('.', $key);
        $filepath = $input[0];
        unset($input[0]);
        $key = implode('.', $input);

        static::load($filepath);

        if ( ! empty($key))
        {
            return static::$items[ $key];
        }

        return static::$items;
    }

}