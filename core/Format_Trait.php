<?php
/**
 * Prayer Times Calculator (ver 1.2.2)
 * *
 * PrayTime.php: Prayer Times Calculator (ver 1.2.2)
 * Copyright (C) 2007-2010 PrayTimes.org
 *
 * Developer: Hamid Zarrabi-Zadeh
 * License: GNU LGPL v3.0
 *
 * TERMS OF USE:
 *     Permission is granted to use this code, with or
 *     without modification, in any website or application
 *     provided that credit is given to the original work
 *     with a link back to PrayTimes.org.
 *
 * This program is distributed in the hope that it will
 * be useful, but WITHOUT ANY WARRANTY.
 *
 * PLEASE DO NOT REMOVE THIS COPYRIGHT BLOCK.
 *
 * ***********************************************************
 *   Code modified, cleaned, and organized by SalahHour.com
 *                 www.SalahHour.com
 * ************************************************************
 *
 * @author    Hamid Zarrabi-Zadeh
 * @copyright GNU LGPL v3.0
 */

/**
 * Time Formatting
 */
trait FormatTrait
{
    /**
     * Time Formats
     */
    public $time24     = 0;    // 24-hour format
    public $time12     = 1;    // 12-hour format
    public $time12NS   = 2;    // 12-hour format with no suffix
    public $float      = 3;    // floating point number

    public $invalidTime = '-----';     // The string used for invalid times

    /**
     * Get offset from a timezone
     *
     * @param string $userTimeZone
     * @param dateTime $date
     *
     * @return type
     */
    public function getOffset($userTimeZone, $dateTime = 'now')
    {
        $userDateTimeZone = new DateTimeZone($userTimeZone);
        $userDateTime     = new DateTime($dateTime, $userDateTimeZone);
        return ($userDateTimeZone->getOffset($userDateTime) / 3600);
    }

    /**
     * set the time format
     *
     * @param int $timeFormat
     */
    public function setTimeFormat($timeFormat)
    {
        $this->timeFormat = $timeFormat;
    }

    /**
     * Convert float hours to 24h format
     *
     * @param timestamp $time
     * @return timestamp
     */
    public function floatTotime24($time)
    {
        if (is_nan($time)) {
            return $this->invalidTime;
        }
        $time = $this->fixhour($time+ 0.5/ 60);  // add 0.5 minutes to round
        $hours = floor($time);
        $minutes = floor(($time- $hours)* 60);
        return $this->twoDigitsFormat($hours). ':'. $this->twoDigitsFormat($minutes);
    }

    /**
     * Convert float hours to 12h format
     *
     * @param timestamp $time
     * @param boolean $noSuffix
     *
     * @return timestamp
     */
    public function floatTotime12($time, $noSuffix = false)
    {
        if (is_nan($time)) {
            return $this->invalidTime;
        }

        $time = $this->fixhour($time+ 0.5/ 60);  // add 0.5 minutes to round
        $hours = floor($time);
        $minutes = floor(($time- $hours)* 60);

        $suffix = $hours >= 12 ? ' %pm%' : ' %am%';
        $hours = ($hours+ 12- 1)% 12+ 1;
        return $hours. ':'. $this->twoDigitsFormat($minutes). ($noSuffix ? '' : $suffix);
    }
}