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
 * Calculation Functions
 *
 * References:
 * http://www.ummah.net/astronomy/saltime
 * http://aa.usno.navy.mil/faq/docs/SunApprox.html
 */
trait CalculationTrait
{
    /**
     * Compute declination angle of sun and equation of time
     *
     * @param double $jd
     * @return double
     */
    public function sunPosition($jd)
    {
        $D = $jd - 2451545.0;
        $g = $this->fixangle(357.529 + 0.98560028* $D);
        $q = $this->fixangle(280.459 + 0.98564736* $D);
        $L = $this->fixangle($q + 1.915* $this->dsin($g) + 0.020* $this->dsin(2*$g));

        $R = 1.00014 - 0.01671* $this->dcos($g) - 0.00014* $this->dcos(2*$g);
        $e = 23.439 - 0.00000036* $D;

        $d = $this->darcsin($this->dsin($e)* $this->dsin($L));
        $RA = $this->darctan2($this->dcos($e)* $this->dsin($L), $this->dcos($L))/ 15;
        $RA = $this->fixhour($RA);
        $EqT = $q/15 - $RA;

        return array($d, $EqT);
    }

    /**
     * Compute equation of time
     *
     * @param double $jd
     * @return double
     */
    public function equationOfTime($jd)
    {
        $sp = $this->sunPosition($jd);
        return $sp[1];
    }

    /**
     * Compute declination angle of sun
     *
     * @param double $jd
     * @return double
     */
    public function sunDeclination($jd)
    {
        $sp = $this->sunPosition($jd);
        return $sp[0];
    }

    /**
     * Compute mid-day (Dhuhr, Zawal) time
     *
     * @param double $t
     * @return double
     */
    public function computeMidDay($t)
    {
        $T = $this->equationOfTime($this->julianDate+ $t);
        $Z = $this->fixhour(12- $T);
        return $Z;
    }

    /**
     * Compute time for a given angle G
     *
     * @param double $G
     * @param double $t
     * @return double
     */
    public function computeTime($G, $t)
    {
        $D = $this->sunDeclination($this->julianDate+ $t);
        $Z = $this->computeMidDay($t);
        $V = 1/15* $this->darccos((-$this->dsin($G)- $this->dsin($D)* $this->dsin($this->lat))/
                ($this->dcos($D)* $this->dcos($this->lat)));
        return $Z+ ($G>90 ? -$V : $V);
    }

    /**
     * Compute the time of Asr
     *
     * Shafii: step=1, Hanafi: step=2
     *
     * @param double $step
     * @param double $t
     * @return double
     */
    public function computeAsr($step, $t)
    {
        $D = $this->sunDeclination($this->julianDate+ $t);
        $G = -$this->darccot($step+ $this->dtan(abs($this->lat- $D)));
        return $this->computeTime($G, $t);
    }
}