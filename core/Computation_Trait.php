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
 * Compute Prayer Times
 */
trait ComputationTrait
{
    /**
     * Compute prayer times at given julian date
     *
     * @param int $times
     * @return int
     */
    public function computeTimes($times)
    {
        $t = $this->dayPortion($times);

        $Fajr    = $this->computeTime(180- $this->methodParams[0], $t[0]);
        $Sunrise = $this->computeTime(180- 0.833, $t[1]);
        $Dhuhr   = $this->computeMidDay($t[2]);
        $Asr     = $this->computeAsr(1+ $this->asrJuristic, $t[3]);
        $Sunset  = $this->computeTime(0.833, $t[4]);;
        $Maghrib = $this->computeTime($this->methodParams[2], $t[5]);
        $Isha    = $this->computeTime($this->methodParams[4], $t[6]);

        return array($Fajr, $Sunrise, $Dhuhr, $Asr, $Sunset, $Maghrib, $Isha);
    }

    /**
     * Compute prayer times at given julian date
     *
     * @return int
     */
    public function computeDayTimes()
    {
        $times = array(5, 6, 12, 13, 18, 18, 18); //default times

        for ($i=1; $i<=$this->numIterations; $i++) {
            $times = $this->computeTimes($times);
        }

        $times = $this->adjustTimes($times);
        return $this->adjustTimesFormat($times);
    }

    /**
     * Adjust times in a prayer time array
     *
     * @param int $times
     * @return int
     */
    public function adjustTimes($times)
    {
        for ($i=0; $i<7; $i++) {
            $times[$i] += $this->timeZone- $this->lng/ 15;
        }

        if ($this->methodParams[1] == 1) { // Maghrib
            $times[5] = $times[4]+ $this->methodParams[2]/ 60;
        }

        if ($this->methodParams[3] == 1) { // Isha
            $times[6] = $times[5]+ $this->methodParams[4]/ 60;
        }

        if ($this->adjustHighLats != $this->none) {
            $times = $this->adjustHighLatTimes($times);
        }
        return $times;
    }

    /**
     * Convert times array to given time format
     *
     * @param int $times
     * @return int
     */
    public function adjustTimesFormat($times)
    {
        if ($this->timeFormat == $this->float) {
            return $times;
        }
        for ($i=0; $i<7; $i++) {
            if ($this->timeFormat == $this->time12) {
                $times[$i] = $this->floatTotime12($times[$i]);
            } else if ($this->timeFormat == $this->time12NS) {
                $times[$i] = $this->floatTotime12($times[$i], true);
            } else {
                $times[$i] = $this->floatTotime24($times[$i]);
            }
        }
        return $times;
    }

    /**
     * Adjust Fajr, Isha and Maghrib for locations in higher latitudes
     *
     * @param int $times
     * @return int
     */
    public function adjustHighLatTimes($times)
    {
        $nightTime = $this->timeDiff($times[4], $times[1]); // sunset to sunrise

        // Adjust Fajr
        $FajrDiff = $this->nightPortion($this->methodParams[0])* $nightTime;
        if (is_nan($times[0]) || $this->timeDiff($times[0], $times[1]) > $FajrDiff) {
            $times[0] = $times[1]- $FajrDiff;
        }

        // Adjust Isha
        $IshaAngle = ($this->methodParams[3] == 0) ? $this->methodParams[4] : 18;
        $IshaDiff = $this->nightPortion($IshaAngle)* $nightTime;
        if (is_nan($times[6]) || $this->timeDiff($times[4], $times[6]) > $IshaDiff) {
            $times[6] = $times[4]+ $IshaDiff;
        }

        // Adjust Maghrib
        $MaghribAngle = ($this->methodParams[1] == 0) ? $this->methodParams[2] : 4;
        $MaghribDiff = $this->nightPortion($MaghribAngle)* $nightTime;
        if (is_nan($times[5]) || $this->timeDiff($times[4], $times[5]) > $MaghribDiff) {
            $times[5] = $times[4]+ $MaghribDiff;
        }

        return $times;
    }

    /**
     * The night portion used for adjusting times in higher latitudes
     *
     * @param int $angle
     * @return int
     */
    public function nightPortion($angle)
    {
        if ($this->adjustHighLats == $this->angleBased) {
            return 1/60* $angle;
        }
        if ($this->adjustHighLats == $this->midNight) {
            return 1/2;
        }
        if ($this->adjustHighLats == $this->oneSeventh) {
            return 1/7;
        }
    }

    /**
     * Convert hours to day portions
     *
     * @param int $times
     * @return int
     */
    public function dayPortion($times)
    {
        for ($i=0; $i<7; $i++) {
            $times[$i] /= 24;
        }
        return $times;
    }
}