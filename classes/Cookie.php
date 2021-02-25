<?php
 namespace ALCPT_QUIZ;

class  Cookie
{
    public static function setCookie($name,$value,$time)
    {
        setcookie($name, $value, time()+$time);
    }
    public static function getCookie($name)
    {
        return $_COOKIE[$name];
    }
}
