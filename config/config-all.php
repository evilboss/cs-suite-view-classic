<?php
/**
 * Created by IntelliJ IDEA.
 * User: gilbertor
 * Date: 8/27/15
 * Time: 11:35 AM
 */

// configuration file all
$file_path = "";
$camera = array(1 =>
    /*CTV TECH*/
      array('camera_name' => "crk01-ctv-003",
        'camera_status' => "OK",
        'camera_location' => "Building #1 - Tech Area",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/ctv-tech/public_html/crk01-ctv-003/",
        'camera_base_url' => " http://toolbox.process-box.com/ctv-tech/crk01-ctv-003",
        'camera_ip' => "10.1.41.60",
        'camera_rtsp_loca' => "rtsp://10.1.41.60:554",
        'camera_rtsp_internet' => "rtsp://210.4.117.50:8081",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120",

        'camera_rtsp_username' => 'Admin',
        'camera_rtsp_password' => '    < See A/C Manager >'
    ),
    array('camera_name' => "crk04-ctv-002",
        'camera_status' => "OK",
        'camera_location' => "Building #4 - Tech Area",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/ctv-tech/public_html/crk04-ctv-002/",
        'camera_base_url' => " http://toolbox.process-box.com/ctv-tech/crk04-ctv-002",
        'camera_ip' => "10.4.100.111",
        'camera_rtsp_loca' => "rtsp://10.4.100.111:554",
        'camera_rtsp_internet' => "rtsp://210.4.117.50:8081",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120",

        'camera_rtsp_username' => 'Admin',
        'camera_rtsp_password' => '    < See A/C Manager >'
    ),
    array('camera_name' => "crk04-ctv-003",
        'camera_status' => "OK",
        'camera_location' => "Building #4 - Tech Store",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/ctv-tech/public_html/crk04-ctv-003/",
        'camera_base_url' => "http://toolbox.process-box.com/ctv-tech/crk04-ctv-003",
        'camera_ip' => "10.4.100.119",
        'camera_rtsp_loca' => "rtsp://10.4.100.119:554",
        'camera_rtsp_internet' => "rtsp://210.4.117.50:8090",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120",
        'camera_rtsp_username' => 'Admin',
        'camera_rtsp_password' => '< see A/C Manager >'

    ),
    array('camera_name' => "crk03-ctv-001",
        'camera_status' => "OK",
        'camera_location' => "Noc Area - B3 Level 2",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/ctv-tech/public_html/crk03-ctv-001",
        'camera_base_url' => "http://toolbox.process-box.com/ctv-tech/crk03-ctv-001",
        'camera_ip' => "10.3.100.130",
        'camera_rtsp_loca' => "rtsp://10.3.100.130:554",
        'camera_rtsp_internet' => "rtsp://210.4.114.122:8053",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120",
        'camera_rtsp_username' => 'Admin',
        'camera_rtsp_password' => '< see A/C Manager >'

    ),
    /*CTV HOUSE*/
    array('camera_name' => "crk90-ctv-005",
        'camera_status' => "OK",
        'camera_location' => "Gravel Filter",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/cctv/files/" . "crk90-ctv-005" . "/",
        'camera_base_url' => "http://toolbox.process-box.com/" . "ctv-house" . "/" . "crk90-ctv-005",
        'camera_ip' => "192.168.88.21",
        'camera_rtsp_loca' => "rtsp://192.168.88.21:554",
        'camera_rtsp_internet' => "rtsp://203.32.10.1:5854",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120",

        'camera_rtsp_username' => 'Admin',
        'camera_rtsp_password' => '    < See A/C Manager >'


    ),
    array('camera_name' => "crk90-ctv-006",
        'camera_status' => "OK",
        'camera_location' => "Fish Wall",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/cctv/files/" . "crk90-ctv-006" . "/",
        'camera_base_url' => "http://toolbox.process-box.com/" . "ctv-house" . "/crk90-ctv-006",
        'camera_ip' => "192.168.88.67",
        'camera_rtsp_loca' => "rtsp://192.168.88.67:554",
        'camera_rtsp_internet' => "rtsp://203.32.10.1:4544",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120"

    ,

        'camera_rtsp_username' => 'Admin',
        'camera_rtsp_password' => '< see A/C Manager >'

    ),
    /*CTV IF*/
    array('camera_name' => "crk02-ctv-002",
        'camera_status' => "OK",
        'camera_location' => "Building #1 - Level 4",
        'camera_number' => "01",
        'camera_res' => "1280x720",
        'camera_homedir' => "/home/users/cctv/files/" . "crk02-ctv-002" . "/",
        'camera_base_url' => "http://toolbox.process-box.com/" . "ctv-if" . "/" . "crk02-ctv-002",
        'camera_ip' => "10.1.41.60",
        'camera_rtsp_loca' => "rtsp://10.1.41.60:554",
        'camera_rtsp_internet' => "rtsp://210.4.107.2:8061",
        'camera_thumb_width' => "220",
        'camera_thumb_height' => "120",

        'camera_rtsp_username' => 'ctv-if',
        'camera_rtsp_password' => 'See A/C Manager'


    ),
    /*CTV AFS*/
    array('camera_name'=>"crk02-ctv-003",
        'camera_status'=>"OK",
        'camera_location'=>"Building #2 - L3 - East",
        'camera_number'=>"01",
        'camera_res'=>"1280x720",
        'camera_homedir'=>"/home/users/cctv/files/" . "crk02-ctv-003" . "/",
        'camera_base_url'=>"http://toolbox.process-box.com/" . "ctv-afs" . "/" . "crk02-ctv-003",
        'camera_ip'=>"10.2.0.219",
        'camera_rtsp_loca'=>"rtsp://10.2.0.219:554",
        'camera_rtsp_internet'=>"rtsp://210.4.107.2:8358" ,
        'camera_thumb_width'=>"220",
        'camera_thumb_height'=>"120",

        'camera_rtsp_username'=>'Admin',
        'camera_rtsp_password'=>'    < See A/C Manager >'




    ),
    array('camera_name'=>"crk02-ctv-004",
        'camera_status'=>"OK",
        'camera_location'=>"Building #2 - L3 - West",
        'camera_number'=>"01",
        'camera_res'=>"1280x720",
        'camera_homedir'=>"/home/users/cctv/files/" . "crk02-ctv-004" . "/",
        'camera_base_url'=>"http://toolbox.process-box.com/" .  "ctv-afs" . "/crk02-ctv-004",
        'camera_ip'=>"10.2.0.254",
        'camera_rtsp_loca'=>"rtsp://10.2.0.254:554",
        'camera_rtsp_internet'=>"rtsp://210.4.107.2:8259" ,
        'camera_thumb_width'=>"220",
        'camera_thumb_height'=>"120"

    ,

        'camera_rtsp_username'=>'Admin',
        'camera_rtsp_password'=>'< see A/C Manager >'

    )

);

$period = array(1 =>
    array(
        'period_label' => "Open",
        'period_start_label' => "4:50am",
        'period_end_label' => "4:50am",
        'period_start' => "0450",
        'period_end' => "0500"
    ),

    array(
        'period_label' => "Before Shift",
        'period_start_label' => "7:00am",
        'period_end_label' => "4:50am",
        'period_start' => "0700",
        'period_end' => "0710"
    ),


    array(
        'period_label' => "Start Shift",
        'period_start_label' => "7:30am",
        'period_end_label' => "4:50am",
        'period_start' => "0730",
        'period_end' => "0740"
    ),


    array(
        'period_label' => "Start Lunch",
        'period_start_label' => "12:00pm",
        'period_end_label' => "4:50am",
        'period_start' => "1200",
        'period_end' => "1210"
    ),

    array(
        'period_label' => "Mid Lunch",
        'period_start_label' => "12:25pm",
        'period_end_label' => "4:50am",
        'period_start' => "1225",
        'period_end' => "1240"
    ),

    array(
        'period_label' => "End Lunch",
        'period_start_label' => "12:55pm",
        'period_end_label' => "4:50am",
        'period_start' => "1255",
        'period_end' => "1305"
    ),

    array(
        'period_label' => "End Shift",
        'period_start_label' => "4:55pm",
        'period_end_label' => "4:50am",
        'period_start' => "1655",
        'period_end' => "1705"
    ),

    array(
        'period_label' => "After Shift",
        'period_start_label' => "5:30pm",
        'period_end_label' => "4:50am",
        'period_start' => "1730",
        'period_end' => "1750"
    ),
);