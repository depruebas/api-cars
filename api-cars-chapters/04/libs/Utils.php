<?php

  function debug( $var)
  {
    $debug = debug_backtrace();
    echo "<pre>";
    echo $debug[0]['file']." ".$debug[0]['line']."<br><br>";
    print_r($var);
    echo "</pre>";
    echo "<br>";
  }

  function debug_cli( $var)
  {
    $debug = debug_backtrace();
    echo "<pre>";
    echo $debug[0]['file']." ".$debug[0]['line']."\n\n";
    print_r($var);
    echo "</pre>";
    echo "\n";
  }


  function formatPeriod( $duration)
  {

    $hours = (int) ($duration / 60 / 60);
    $minutes = (int) ($duration / 60) - $hours * 60;
    $seconds = (int) $duration - $hours * 60 * 60 - $minutes * 60;

    return (
        $hours == 0 ? "00":$hours) . ":" . (
        $minutes == 0 ? "00":($minutes < 10? "0".$minutes:$minutes)) . ":" . (
        $seconds == 0 ? "00":($seconds < 10? "0".$seconds:$seconds)
    );

  }

  function RandomString()
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';

    for ($i = 0; $i < 20; $i++)
    {
        $randstring .= strtolower( $characters[rand(0, strlen($characters)-1)]);
    }

    return $randstring.date( 'is');
  }