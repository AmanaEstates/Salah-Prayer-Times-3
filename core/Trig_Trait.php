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
 * Trigonometric Functions
 */
trait TrigTrait
{
    /**
     * Degree sin
     *
     * @param int $d
     * @return int
     */
    public function dsin($d)
    {
        return sin($this->dtr($d));
    }

    /**
     * Degree cos
     *
     * @param int $d
     * @return int
     */
    public function dcos($d)
    {
        return cos($this->dtr($d));
    }

    /**
     * Degree tan
     *
     * @param int $d
     * @return int
     */
    public function dtan($d)
    {
        return tan($this->dtr($d));
    }

    /**
     * Degree arcsin
     *
     * @param int $x
     * @return int
     */
    public function darcsin($x)
    {
        return $this->rtd(asin($x));
    }

    /**
     * Degree arccos
     *
     * @param int $x
     * @return int
     */
    public function darccos($x)
    {
        return $this->rtd(acos($x));
    }

    /**
     * Degree arctan
     *
     * @param int $x
     * @return int
     */
    public function darctan($x)
    {
        return $this->rtd(atan($x));
    }

    /**
     * Degree arctan2
     *
     * @param int $y
     * @param int $x
     * @return int
     */
    public function darctan2($y, $x)
    {
        return $this->rtd(atan2($y, $x));
    }

    /**
     * Degree arccot
     *
     * @param int $x
     * @return int
     */
    public function darccot($x)
    {
        return $this->rtd(atan(1/$x));
    }

    /**
     * Degree to radian
     *
     * @param int $d
     * @return int
     */
    public function dtr($d)
    {
        return ($d * M_PI) / 180.0;
    }

    /**
     * Radian to degree
     *
     * @param int $r
     * @return int
     */
    public function rtd($r)
    {
        return ($r * 180.0) / M_PI;
    }

    /**
     * Range reduce angle in degrees.
     *
     * @param int $a
     * @return int
     */
    public function fixangle($a)
    {
        $a = $a - 360.0 * floor($a / 360.0);
        $a = $a < 0 ? $a + 360.0 : $a;
        return $a;
    }

    /**
     * Range reduce hours to 0..23
     *
     * @param int $a
     * @return int
     */
    public function fixhour($a)
    {
        $a = $a - 24.0 * floor($a / 24.0);
        $a = $a < 0 ? $a + 24.0 : $a;
        return $a;
    }
}