<?php
/**
 * Settings object
 *
 * @author    Amana Estats, Inc.
 * @copyright All rights reserved
 * @link      http://www.SalahHour.com
 * @using     Codeigniter 3.1.2
 */

/**
 * Settings
 *
 * @author    Amana Estats, Inc.
 * @copyright All rights reserved
 * @link      http://www.SalahHour.com
 * @extends   MY_Controller
 */
class Settings
{
    /**
     * Do we have a country for defaults?
     *
     * @param string $country
     */
    public function __construct($country = false)
    {
        if ($country != false) {
            if (in_array($country, Settings_Constants::$hanafi_countries)) {
                $this->juristic = 1;
            }

            if (isset(Settings_Constants::$method_countries[$country])) {
                $this->method = Settings_Constants::$method_countries[$country];
            }
        }
    }

    /**
     * Settings Name
     *
     * @var string
     */
    public $name = 'Default Settings';

    /**
     * Location [city, state, country]
     *
     * @var array
     */
    public $location = array('', '', '');

    public $latitude = 0;
    public $longitude = 0;
    public $timezone = 0;

    /**
     * Calculation Method
     *
     * Full list see: BASE/core/Settings_Constants.php
     *
     * @var int
     */
    public $method = 3;

    /**
     * Juristic Methods
     *
     * 0 - Shafii (Default)
     * 1 - Hanafi
     *
     * @var int
     */
    public $juristic = 0;

    /**
     * High Latitude Calculation
     *
     * 0 - None
     * 1 - Mid Night (Default)
     * 2 - One Seventh
     * 3 - Angle Based
     */
    public $high_latitude = 1;

    /**
     * Rules for calculation 0 -> angle, 1-> minutes
     *
     * @var array
     */
    public $fajir_rule      = array(0, 15.0);
    public $maghrib_rule    = array(1, 0);
    public $isha_rule       = array(0, 15.0);

    /**
     * Time formats
     *
     * 0 -> 24-hour format
     * 1 -> 12-hour format
     * 2 -> 12-hour format without suffix
     * 3 -> Floating point number
     *
     * @var int
     */
    public $time_format = 1;
}