<?php
/**
 * Example Usage
 *
 * @author    Amana Estats, Inc.
 * @copyright All rights reserved
 * @link      http://www.SalahHour.com
 * @using     Codeigniter 3.1.2
 */

/**
 * Example Usage
 *
 * @author    Amana Estats, Inc.
 * @copyright All rights reserved
 * @link      http://www.SalahHour.com
 * @extends   MY_Controller
 */

// Require core file
define('DS', DIRECTORY_SEPARATOR);
require dirname(__FILE__) . DS . 'core' . DS . 'Prayer_Times.php';

/**
 * Create our location settings
 */
// By specifing a country, it will automatically detect method/madhab
$settings = new Settings('US');
$settings->location     = array('Detroit', 'Michigan', 'US');
$settings->latitude     = 42.4056;
$settings->longitude    = -83.0531;
$settings->timezone     = 'America/Detroit';

// Get times for next 7 days
$today      = date('Y-m-d');
$next_week  = date('Y-m-d', strtotime('+7 days'));
$begin      = new DateTime($today);
$end        = new DateTime($next_week);
$interval   = new DateInterval('P1D');
$daterange  = new DatePeriod($begin, $interval, $end);

// Set Prayer Object
$prayer = new Prayer_Times($settings);

echo 'Prayer times for: ' . implode(', ', $settings->location) . PHP_EOL;
foreach($daterange as $date){
    $times = $prayer->getPrayerTimes($date->getTimeStamp());
    echo '--------------------';
    echo $date->format('D M jS Y') . PHP_EOL;
    echo 'Fajir: '      . format_am_pm($times[0]) . PHP_EOL;
    echo 'Duha: '       . format_am_pm($times[1]) . PHP_EOL;
    echo 'Dhur: '       . format_am_pm($times[2]) . PHP_EOL;
    echo 'Asr: '        . format_am_pm($times[3]) . PHP_EOL;
    echo 'Sunet: '      . format_am_pm($times[4]) . PHP_EOL;
    echo 'Maghrib: '    . format_am_pm($times[5]) . PHP_EOL;
    echo 'Isha: '       . format_am_pm($times[6]) . PHP_EOL;
}

function format_am_pm($el) { return str_replace(array('%am%', '%pm%'), array('AM', 'PM'), $el);}