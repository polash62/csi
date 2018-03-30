<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('savelogdata')) {

    function savelogdata($action,$user_level) {
        $CI = & get_instance();
        $UI = & get_instance();
        $userrole = $UI->session->userdata('user_level_8');
        $CI->load->library('user_agent');
        $hostname = gethostname();
        $device   = 'Host Name: ' . gethostname(). '  | ' . 'OS: ' . $CI->agent->platform();
        if ($CI->agent->is_browser()) {
            $browser = $CI->agent->browser() . ' ' . $CI->agent->version();
        } elseif ($CI->agent->is_robot()) {
            $browser = $CI->agent->robot();
        } elseif ($CI->agent->is_mobile()) {
            $browser = $CI->agent->mobile();
        } else {
            $browser = 'Undefined User Agent';
        }
        $ip = $_SERVER['REMOTE_ADDR'];

        $locationinfo = json_decode(file_get_contents("http://ipinfo.io/$ip/json"));
        $location = "";
        if (isset($locationinfo->city)):
            $location .= ' City: ' . $locationinfo->city;
        endif;
        if (isset($locationinfo->region)):
            $location .= ', Region: ' . $locationinfo->region;
        endif;
        if (isset($locationinfo->country)):
            $location .= ', Country: ' . $locationinfo->country;
        endif;
        $timezone = +6; //(GMT -5:00) EST (U.S. & Canada)
        $gmtdate = gmdate("Y-m-d H:i:s", time() + 3600 * ($timezone + date("I")));


        ob_start();
        //Get the ipconfig details using system commond
        system('ipconfig /all');
        // Capture the output into a variable
        $mycomsys = ob_get_contents();
        // Clean (erase) the output buffer
        ob_clean();
        $find_mac = "Physical"; //find the "Physical" & Find the position of Physical text
        $pmac = strpos($mycomsys, $find_mac);
        // Get Physical Address
        $macaddress = substr($mycomsys, ($pmac + 36), 17);
        //Display Mac Address


        $logdataarray = array(

            'user_id' => $user_level,
            'user_role' => $userrole,
            'action' => $action,
            'device' => $device,
            'browser' => $browser,
            'ip' => $ip,
            'time' => $gmtdate,
            'host_name'=>$hostname
        );
        $savestatus = $CI->db->insert('csi_logdata', $logdataarray);
    }

}


?>