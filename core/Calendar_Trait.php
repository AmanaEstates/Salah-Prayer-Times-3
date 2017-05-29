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
 * Julian Date Functions
 */
trait CalendarTrait
{
    /**
     * Convert julian date from a calendar date
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return int
     */
    public function julianDate($year, $month, $day)
    {
        if ($month <= 2)
        {
            $year -= 1;
            $month += 12;
        }
        $A = floor($year/ 100);
        $B = 2- $A+ floor($A/ 4);

        $JD = floor(365.25* ($year+ 4716))+ floor(30.6001* ($month+ 1))+ $day+ $B- 1524.5;
        return $JD;
    }

    /**
     * Convert a calendar date to julian date (second method)
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @return int
     */
    public function calcJD($year, $month, $day)
    {
        $J1970 = 2440588.0;
        $date = $year. '-'. $month. '-'. $day;
        $ms = strtotime($date);   // # of milliseconds since midnight Jan 1, 1970
        $days = floor($ms/ (1000 * 60 * 60* 24));
        return $J1970+ $days- 0.5;
    }
}