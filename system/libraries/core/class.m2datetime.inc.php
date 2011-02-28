<?php

/**
 * Date/Time related functions
 * @author M2Mobi, Heinz Wiesinger
 */
class M2DateTime
{

    /**
     * Constructor
     */
    public function __construct()
    {

    }

    /**
     * Destructor
     */
    public function __destruct()
    {

    }

    /**
     * Return today's date (YYYY-MM-DD)
     * @return String Today's date
     */
    public static function today()
    {
        return date('Y-m-d');
    }

    /**
     * Return yesterday's date (YYYY-MM-DD)
     * @return String Tomorrow's date
     */
    public static function yesterday()
    {
        return date('Y-m-d', strtotime("-1 day"));
    }

    /**
     * Return tomorrow's date (YYYY-MM-DD)
     * @return String Tomorrow's date
     */
    public static function tomorrow()
    {
        return date('Y-m-d', strtotime("+1 day"));
    }

    /**
     * Return a date of a certain timeframe in the past/future
     * @param String $delay Definition for a timeframe ("+1 day", "-10 minutes")
     * @return String Delayed date
     */
    public static function delayed_date($delay)
    {
        return date('Y-m-d', strtotime($delay));
    }

    /**
     * Return a timestamp of a certain timeframe in the past/future
     * @param String $delay Definition for a timeframe ("+1 day", "-10 minutes")
     * @return Integer Delayed timestamp
     */
    public static function delayed_timestamp($delay)
    {
        return strtotime($delay);
    }

    /**
     * Return the current time (HH:MM:SS)
     * @return String current time
     */
    public static function now()
    {
        return strftime("%H:%M:%S", time());
    }

    /**
     * Returns a MySQL compatible date definition
     * @param Integer $timestamp PHP-like Unix Timestamp
     * @return String $date Date as a string
     */
    public static function get_date($timestamp)
    {
        return date('Y-m-d', $timestamp);
    }

    /**
     * Returns a MySQL compatible time definition
     * @param Integer $timestamp PHP-like Unix Timestamp
     * @return String $time Time as a string
     */
    public static function get_time($timestamp)
    {
        return strftime("%H:%M:%S", $timestamp);
    }

    /**
     * Returns a MySQL compatible Date & Time definition
     * @param Integer $timestamp PHP-like Unix Timestamp (optional)
     * @return String $datetime Date & Time as a string
     */
    public static function get_datetime($timestamp = FALSE)
    {
        if ($timestamp === FALSE)
        {
            return date('Y-m-d H:i', time());
        }
        else
        {
            return date('Y-m-d H:i', $timestamp);
        }
    }

    /**
     * Return a date formatted as "DD MMM" (eg 05 Dec)
     * @param Integer $timestamp PHP-like Unix Timestamp (optional)
     * @param String $locale The locale that should be used for the month names (optional, en_US by default)
     * @return String $date Date as a string
     */
    public static function get_human_readable_date_short($timestamp = FALSE, $locale = "en_US")
    {
        setlocale(LC_ALL, $locale);
        if ($timestamp === FALSE)
        {
            return strtoupper(strftime('%d %b', time()));
        }
        else
        {
            return strtoupper(strftime('%d %b', $timestamp));
        }
    }

    /**
     * Checks whether a given input string is a valid time definition
     * @param String $string Input String
     * @return Boolean $return True if it is valid, False otherwise
     */
    public static function is_time($string)
    {
        // accepts HHH:MM:SS, e.g. 23:59:30 or 12:30 or 120:17
        if ( ! preg_match("/^(\-)?[0-9]{1,3}(:[0-9]{2})+$/", $string) )
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    /**
     * Checks whether a given input string is a valid time definition
     * or not and in case it is, it returns the proper date to look on the db (YYYY-MM-DD)
     * @param String $string Input String
     * @return Mixed The string properly formatted for db consults if it is valid, False otherwise
     */
    public static function is_date($string)
    {
        // accepts YYY-MM-DD and YYYY/MM/DD, e.g. 2010/10/25 or 2003-01-28
        if(strlen($string) == 10)
        {
            $try1 = explode('/',$string);
            if(count($try1) == 3 && strlen($try1[0]) == 4 &&
                strlen($try1[1]) == 2 && strlen($try1[2]) == 2 &&
                $try1[1] <= 12 && $try1[2] <= 31)
            {
                $date = $string;
                $date = str_replace("/","-", $date);
                return $date;
            }
            else
            {
                $try2 = explode('-',$string);

                if(count($try2) == 3 && strlen($try2[0]) == 4 &&
                    strlen($try2[1]) == 2 && strlen($try2[2]) == 2 &&
                    $try2[1] <= 12 && $try2[2] <= 31)
                {
                    return $string;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            return FALSE;
        }
    }

   /**
    * Function to convert a MySQL datetime (YYYY-MM-DD HH:MM:SS) into a Unix timestamp
    * @param String datetime The string to be formatted
    * @return Integer Unix Timestamp
    */
    public static function get_timestamp_from_datetime($datetime)
    {
        list($date, $time) = explode(' ', $datetime);
        list($year, $month, $day) = explode('-', $date);
        list($hour, $minute, $second) = explode(':', $time);

        $timestamp = mktime($hour, $minute, $second, $month, $day, $year);

        return $timestamp;
    }
}

?>
