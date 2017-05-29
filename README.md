# Salah Prayer Times 1

A cleaner and more standarized version of:
http://praytimes.org/code/git/?a=tree&p=PrayTimes&hb=HEAD&f=v1/php

# How to use

Prayer times need the following information to be generated:

 - Latitude
 - Longitude
 - GMT offset
 - Date
 
To use simple include the main core file `see Example.php for usage`:

````
define('DS', DIRECTORY_SEPARATOR);
require dirname(__FILE__) . DS . 'core' . DS . 'Prayer_Times.php';
````

Then intialize a location/setting object:

```
$settings               = new Settings('US');
$settings->location     = array('Detroit', 'Michigan', 'US');
$settings->latitude     = 42.4056;
$settings->longitude    = -83.0531;
$settings->timezone     = 'America/Detroit';
```

This will automatically assign the method/madhab based on the country (US). Not not all countries have defaults so you can do the following additional sets:

```
$settings->method = 4; // See below for complete list of methods
$settings->juristic = 0; // (0 - Shafi/Hanbli/Maliki, 1 - Hanafi)
```

To access prayer times you call the prayer time library as so:

```
$prayer = new Prayer_Times($settings);
$times = $prayer->getPrayerTimes(time());
echo '--------------------';
echo 'Salah Times for December 25th, 2017' . PHP_EOL;
echo 'Fajir: '      . format_am_pm($times[0]) . PHP_EOL;
echo 'Duha: '       . format_am_pm($times[1]) . PHP_EOL;
echo 'Dhur: '       . format_am_pm($times[2]) . PHP_EOL;
echo 'Asr: '        . format_am_pm($times[3]) . PHP_EOL;
echo 'Maghrib: '    . format_am_pm($times[4]) . PHP_EOL;
echo 'Isha: '       . format_am_pm($times[5]) . PHP_EOL;
```

# Methods

 0) Jafari - Ithna Ashari
 1) Karachi - University of Islamic Sciences
 2) ISNA - Islamic Society of North America
 3) MWL - Muslim World League
 4) Mecca - Umm al-Qura
 5) Egyptian General Authority of Survey
 6) Custom Setting
 7) University of Tehran - Institute of Geophysics
 8) Algerian Minister of Religious Affairs and Wakfs
 9) Gulf 90 Minutes Fixed Isha
 10) Egyptian General Authority of Survey (Bis)
 11) UOIF - Union Des Organisations Islamiques De France
 12) Sistem Informasi Hisab Rukyat Indonesia
 13) Diyanet İşleri Başkanlığı
 14) Germany Custom
 15) Russia Custom
 
# Need help or have any question?
Contact us at amanaestates@gmail.com. You can also visit us at SalahHour.com
