<?php
/**
 * Prayer Times Calculator (ver 1.2.2)
 * *
 * Prayer_times.php: Prayer Times Calculator (ver 1.2.2)
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
 * @author    Hamid Zarrabi-Zadeh
 * @author    Amana Estats, Inc. / SalahHour.com
 * @copyright GNU LGPL v3.0
 */

require dirname(__FILE__) . DS . 'Calculation_Trait.php';
require dirname(__FILE__) . DS . 'Calendar_Trait.php';
require dirname(__FILE__) . DS . 'Computation_Trait.php';
require dirname(__FILE__) . DS . 'Format_Trait.php';
require dirname(__FILE__) . DS . 'Misc_Trait.php';
require dirname(__FILE__) . DS . 'Trig_Trait.php';
require dirname(__FILE__) . DS . 'Settings.php';
require dirname(__FILE__) . DS . 'Settings_Constants.php';

/**
 * Class methods
 *
 * abstract function getPrayerTimes (timestamp);
 * abstract function getDatePrayerTimes (year, month, day);
 *
 * abstract function setHighLatsMethod (methodID);
 *
 * @author    Hamid Zarrabi-Zadeh
 * @author    Amana Estats, Inc.
 * @website   http://SalahHour.com
 * @copyright GNU LGPL v3.0
 */
class Prayer_Times extends Settings_Constants
{
    use FormatTrait, CalculationTrait, ComputationTrait,
            MiscTrait, CalendarTrait, TrigTrait;

    /**
     * Adjusting Methods for Higher Latitudes
     */
    public $none       = 0;    // No adjustment
    public $midNight   = 1;    // middle of night
    public $oneSeventh = 2;    // 1/7th of night
    public $angleBased = 3;    // angle/60th of night

    /**
     * Global Variables
     */
    public $calcMethod      = 3;
    public $asrJuristic     = 0;
    public $adjustHighLats  = 1;
    public $timeFormat      = 1;

    /**
     * Needed vars
     */
    public $lat;
    public $lng;
    public $timeZone;
    public $julianDate;

    /**
     * Technical Settings
     *
     * Number of iterations needed to compute times
     *
     * @var int
     */
    public $numIterations = 1;

    /**
     * Angle/Minute Rules
     *
     * array(fa, ms, mv, is, iv);
     *
     * fa : fajr angle
     *
     * ms : maghrib selector (0 = angle; 1 = minutes after sunset)
     * mv : maghrib parameter value (in angle or minutes)
     *
     * is : isha selector (0 = angle; 1 = minutes after maghrib)
     * iv : isha parameter value (in angle or minutes)
    */
    public $methodParams = array();

    /**
     * User settings
     *
     * @var Settings
     */
    public $settings;

    /**
     * Setup the object
     *
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->calcMethod = $this->settings->method;

        $this->methodParams = array(
            $this->settings->fajir_rule[1],

            $this->settings->maghrib_rule[0],
            $this->settings->maghrib_rule[1],

            $this->settings->isha_rule[0],
            $this->settings->isha_rule[1]
        );

        $this->asrJuristic = $this->settings->juristic;

        $this->lat = $this->settings->latitude;
        $this->lng = $this->settings->longitude;
        $this->adjustHighLats = $this->settings->high_latitude;
        $this->timeFormat = $this->settings->time_format;
    }

    /**
     * Return prayer times for a given date
     *
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return array
     */
    public function getDatePrayerTimes($year, $month, $day)
    {
        $this->timeZone = $this->getOffset($this->settings->timezone, $year . '-' . $month . '-' . $day);
        $this->julianDate = $this->julianDate($year, $month, $day)- $this->lng/ (15* 24);
        return $this->computeDayTimes();
    }

    /**
     * Return prayer times for a given timestamp
     *
     * @param int $timestamp
     *
     * @return array
     */
    public function getPrayerTimes($timestamp)
    {
        $date = getdate($timestamp);
        return $this->getDatePrayerTimes($date['year'], $date['mon'], $date['mday']);
    }

    /**
     * Set adjusting method for higher latitudes
     *
     * @param int $methodID
     */
    public function setHighLatsMethod($methodID)
    {
        $this->adjustHighLats = $methodID;
    }
}