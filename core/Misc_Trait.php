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
 * Misc Functions
 */
trait MiscTrait
{
    /**
     * Compute the difference between two times
     *
     * @param int $time1
     * @param int $time2
     * @return int
     */
    public function timeDiff($time1, $time2)
    {
        return $this->fixhour($time2- $time1);
    }


    /**
     * Add a leading 0 if necessary
     *
     * @param int $num
     * @return int
     */
    public function twoDigitsFormat($num)
    {
        return ($num <10) ? '0'. $num : $num;
    }
}