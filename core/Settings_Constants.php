<?php
/**
 * Setting constants
 *
 * @author    Amana Estats, Inc.
 * @copyright All rights reserved
 * @link      http://www.SalahHour.com
 * @using     Codeigniter 3.1.2
 */

/**
 * Setting Constants
 *
 * @author    Amana Estats, Inc.
 * @copyright All rights reserved
 * @link      http://www.SalahHour.com
 * @extends   MY_Controller
 */
class Settings_Constants
{
    public static $methods = array(
        0 => array(
            'name'          => 'Jafari - Ithna Ashari',
            'name_arabic'   => 'الجعفري - الاثنى عشريه',
            'fajir_rule'    => array(0, 16),
            'maghrib_rule'  => array(1, 4),
            'isha_rule'     => array(0, 14),
        ),
        1 => array(
            'name'          => 'Karachi - University of Islamic Sciences',
            'name_arabic'   => 'كراتشي - جامعة العلوم الإسلامية',
            'fajir_rule'    => array(0, 18),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 18),
        ),
        2 => array(
            'name'          => 'ISNA - Islamic Society of North America',
            'name_arabic'   => 'الجمعية الإسلامية لأمريكا الشمالية',
            'fajir_rule'    => array(0, 15),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 15),
        ),
        3 => array(
            'name'          => 'MWL - Muslim World League',
            'name_arabic'   => 'رابطة العالم الإسلامي',
            'fajir_rule'    => array(0, 18),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 17),
        ),
        4 => array(
            'name'          => 'Mecca - Umm al-Qura',
            'name_arabic'   => 'مكه - ام القرى',
            'fajir_rule'    => array(0, 18.5),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(1, 90),
        ),
        5 => array(
            'name'          => 'Egyptian General Authority of Survey',
            'name_arabic'   => 'الهيئة العامة المصرية للمساحة',
            'fajir_rule'    => array(0, 19.5),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 17.5),
        ),
        6 => array(
            'name'          => 'Custom Setting',
            'name_arabic'   => 'إعداد مخصص',
            'fajir_rule'    => array(0, 18),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 17),
        ),
        7 => array(
            'name'          => 'University of Tehran - Institute of Geophysics',
            'name_arabic'   => 'جامعة طهران - معهد الجيوفيزياء',
            'fajir_rule'    => array(0, 17.7),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 14),
        ),
        8 => array(
            'name'          => 'Algerian Minister of Religious Affairs and Wakfs',
            'name_arabic'   => 'وزارة الشؤون الدينية والأوقاف الجزائرية',
            'fajir_rule'    => array(0, 18),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 17),
        ),
        9 => array(
            'name'          => 'Gulf 90 Minutes Fixed Isha',
            'name_arabic'   => 'الخليج 90 دقيقه العشاء ثابت',
            'fajir_rule'    => array(0, 19.5),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(1, 90),
        ),
        10 => array(
            'name'          => 'Egyptian General Authority of Survey (Bis)',
            'name_arabic'   => 'الهيئة العامة المصرية للمساحة (Bis)',
            'fajir_rule'    => array(0, 20),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 18),
        ),
        11 => array(
            'name'          => 'UOIF - Union Des Organisations Islamiques De France',
            'name_arabic'   => 'الهيئة العامة المصرية اتحاد المنظمات الإسلامية في فرنسا',
            'fajir_rule'    => array(0, 12),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 12),
        ),
        12 => array(
            'name'          => 'Sistem Informasi Hisab Rukyat Indonesia',
            'name_arabic'   => 'نظام المعلومات الاندونيسيا',
            'fajir_rule'    => array(0, 20),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 18),
        ),
        13 => array(
            'name'          => 'Diyanet İşleri Başkanlığı',
            'name_arabic'   => 'الشؤون الدينية التركية',
            'fajir_rule'    => array(0, 18),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 17),
        ),
        14 => array(
            'name'          => 'Germany Custom',
            'name_arabic'   => 'ألمانيا مخصص',
            'fajir_rule'    => array(0, 18),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 16.5),
        ),
        15 => array(
            'name'          => 'Russia Custom',
            'name_arabic'   => 'روسيا مخصص',
            'fajir_rule'    => array(0, 16),
            'maghrib_rule'  => array(1, 0),
            'isha_rule'     => array(0, 15),
        ),
    );

    public static $juristic = array(
        0 => array('name' => 'Standard (Shafi, Hanbli, Maliki)', 'name_arabic' => 'شافعي، حنبلي، مالكي'),
        1 => array('name' => 'Hanafi', 'name_arabic' => 'حنفي'),
    );

    public static $high_latitude = array(
        0 => array('name' => 'None', 'name_arabic' => 'لا شيء'),
        1 => array('name' => 'Midnight', 'name_arabic' => 'منتصف الليل'),
        2 => array('name' => '1/7th', 'name_arabic' => 'السبع'),
        3 => array('name' => 'Angle', 'name_arabic' => 'زاوية'),
    );

    public static $time_format = array(
        0 => array('name' => '24 Hour Format', 'name_arabic' => 'تنسيق 24 ساعة'),
        1 => array('name' => '12 Hour Format', 'name_arabic' => 'تنسيق 12 ساعة'),
        2 => array('name' => '12 Hour Format w/o Suffix', 'name_arabic' => 'تنسيق 12 ساعة من دون لاحق'),
        3 => array('name' => 'Floating Number', 'name_arabic' => 'الرقم الحسابي'),
    );

    public static $hanafi_countries = array(
        'KZ', 'TM', 'KG', 'AF', 'PK', 'BD', 'AZ', 'TR', 'EG', 'TJ', 'MV', 'SY', 'JO', 'UZ'
    );

    public static $method_countries = array(
        // Karachi
        'AF' => 1,
        'BD' => 1,
        'IN' => 1,
        'IR' => 1,
        'PK' => 1,
        'KW' => 1,
        // Algerian
        'DZ' => 8,
        // Fixed 90 Minutes
        'BH' => 9,
        'QA' => 9,
        // Isna
        'CA' => 2,
        'US' => 2,
        // Makkah
        'SA' => 4,
        // Egypt
        'EG' => 5,
        // Egypt BIS
        'BN' => 10,
        'IQ' => 10,
        'JO' => 10,
        'LB' => 10,
        'SY' => 10,
        // France
        'FR' => 11,
        // Indonesia/Malaysia
        'ID' => 12,
        'MY' => 12,
        // Turkey
        'TR' => 13,
    );
}