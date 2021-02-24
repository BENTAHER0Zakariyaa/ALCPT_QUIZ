<?php

namespace ALCPT_QUIZ;

class Session
{
    public static function init()
    {
        session_start();
    }

    public static function setValue(string $sessionName, string $value)
    {
        $_SESSION[$sessionName] = $value;
    }

    public static function getValue(string $sessionName)
    {
        if (isset($_SESSION[$sessionName])) :
            return $_SESSION[$sessionName];
        else :
            return false;
        endif;
    }

    public static function checkSession()
    {
        if (self::getValue("login") == false) :
            self::destroy();
        endif;
    }


    public static function IsLogin()
    {
        return self::getValue("login") == true;
    }

    public static function destroy()
    {
        session_destroy();
        session_unset();
    }
}
?>