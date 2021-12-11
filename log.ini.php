<?php

/*
 * Created on Sat Dec 11 2021 3:09:12 AM
 *
 * Author     : Mile S.
 * Contact    : info@ccwebspot.com
 * Website    : https://ccwebspot.com/
 * Copyright (c) 2021 CC.Webspot
 *
 */

    $USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    /**
     * Get visitor OS 
     */
    function GetOS() {
        global $USER_AGENT;
        $OS_PLATFORM = "Unknow OS Platform.";
        $OS_ARRAY = array(
            '/windows nt 10/i'     =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/kalilinux/i'          =>  'KaliLinux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile',
            '/Windows Phone/i'      =>  'Windows Phone'
        );
        foreach ($OS_ARRAY as $REGEX => $VALUE) {
            if (preg_match($REGEX, $USER_AGENT)) {
                $OS_PLATFORM = $VALUE;
            }
        }
        return $OS_PLATFORM;
    }
    /** 
     * End for OS function
     * Get visitor Browser
     */
    function GetBrowser() {
        global $USER_AGENT;
        $BROWSER = "Unknow Browser.";
        $BROWSER_ARRAY = array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/Mozilla/i'    =>  'Mozila',
            '/Mozilla/5.0/i'=>  'Mozila',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/edge/i'       =>  'Edge',
            '/opera/i'      =>  'Opera',
            '/OPR/i'        =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/Bot/i'        =>  'BOT Browser',
            '/Valve Steam GameOverlay/i'  =>  'Steam',
            '/Googlebot/i'   =>  'GOOGLE Bot',
            '/OrbitFox/i'   =>  'Orbit Fox Bot',
            '/mobile/i'     =>  'Handheld Browser'
        );
        foreach($BROWSER_ARRAY as $REGEX => $VALUE) {
            if(preg_match($REGEX, $USER_AGENT)) {
                $BROWSER = $VALUE;
            }
        }
        return $BROWSER;
    }
    /**
     * End for Browser function
     */
    $USER_OS = GetOS();
    $USER_BROWSER = GetBrowser();
    /**
     * Get visitor IP Address 
     */
    $IP = $_SERVER['REMOTE_ADDR'];
    /**
     * Get visitor location
     * Hide Admin's IP Address
     */
    $WADMIN = "Mile";
    /**
     * 
     */
    $WADMIN_COUNTRY = "SRB";
    if($IP == $WADMIN) {
        $IP = "Mile";
        $COUNTRY = $OWNER_COUNTRY;
        /**
         * If visitor wasn't Admin, it won't change IP Address and it will find info about IP Address
         */
    } else {
        $DETAILS = json_decode(file_get_contents("http://ipinfo.io/{$IP}"));
        $COUNTRY = $DETAILS->country;
    }
    $DATETIME = date_default_timezone_get("Europe/London");
    $DATETIME = date_default_timezone_get();
    $DATETIME = date('D M d, Y  h:i:s a');
    $FILE = $_SERVER['DOCUMENT_ROOT'] . '/logs/log_' . date('Y-m-d') . ".txt";
    $FILE = fopen($FILE, "a");
    $DATA = "
        ------------------------------------------------------------------------------------------------------
        Time - <b> $DATETIME </b>
        IP Address - <b> $IP </b>
        Browser - <b> $USER_BROWSER </b>
        OS - <b> $USER_OS </b>
        Country - <b> $COUNTRY </b>
        User-Agent - <b> $USER_AGENT </b>
        ------------------------------------------------------------------------------------------------------
    ";
    fwrite($FILE, $DATA);
    fclose($FILE);

?>
