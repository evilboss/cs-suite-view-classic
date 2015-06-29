<?php

// configuration file 
$file_path = "";
$camera=array(1=>
    array('camera_name'=>"crk90-ctv-005",
        'camera_status'=>"OK",
        'camera_location'=>"Gravel Filter",
        'camera_number'=>"01",
        'camera_res'=>"1280x720",
        'camera_homedir'=>"/home/users/cctv/files/" . "crk90-ctv-005" . "/",
        'camera_base_url'=>"http://toolbox.process-box.com/" . "ctv-house" . "/" . "crk90-ctv-005",
        'camera_ip'=>"192.168.88.21",
        'camera_rtsp_loca'=>"rtsp://192.168.88.21:554",
        'camera_rtsp_internet'=>"rtsp://203.32.10.1:5854" ,
        'camera_thumb_width'=>"220",
        'camera_thumb_height'=>"120",

        'camera_rtsp_username'=>'Admin',
        'camera_rtsp_password'=>'    < See A/C Manager >'




    ),


    array('camera_name'=>"crk90-ctv-006",
        'camera_status'=>"OK",
        'camera_location'=>"Fish Wall",
        'camera_number'=>"01",
        'camera_res'=>"1280x720",
        'camera_homedir'=>"/home/users/cctv/files/" . "crk90-ctv-006" . "/",
        'camera_base_url'=>"http://toolbox.process-box.com/" .  "ctv-house" . "/crk90-ctv-006",
        'camera_ip'=>"192.168.88.67",
        'camera_rtsp_loca'=>"rtsp://192.168.88.67:554",
        'camera_rtsp_internet'=>"rtsp://203.32.10.1:4544" ,
        'camera_thumb_width'=>"220",
        'camera_thumb_height'=>"120"

    ,

        'camera_rtsp_username'=>'Admin',
        'camera_rtsp_password'=>'< see A/C Manager >'

    )




);

$period=array(1=>
    array(
        'period_label'=>"Open",
        'period_start_label'=>"4:50am",
        'period_end_label'=>"4:50am",
        'period_start'=>"0450",
        'period_end'=>"0500"
    ),

    array(
        'period_label'=>"Before Shift",
        'period_start_label'=>"7:00am",
        'period_end_label'=>"4:50am",
        'period_start'=>"0700",
        'period_end'=>"0710"
    ),


    array(
        'period_label'=>"Start Shift",
        'period_start_label'=>"7:30am",
        'period_end_label'=>"4:50am",
        'period_start'=>"0730",
        'period_end'=>"0740"
    ),


    array(
        'period_label'=>"Start Lunch",
        'period_start_label'=>"12:00pm",
        'period_end_label'=>"4:50am",
        'period_start'=>"1200",
        'period_end'=>"1210"
    ),

    array(
        'period_label'=>"Mid Lunch",
        'period_start_label'=>"12:25pm",
        'period_end_label'=>"4:50am",
        'period_start'=>"1225",
        'period_end'=>"1240"
    ),

    array(
        'period_label'=>"End Lunch",
        'period_start_label'=>"12:55pm",
        'period_end_label'=>"4:50am",
        'period_start'=>"1255",
        'period_end'=>"1305"
    ),

    array(
        'period_label'=>"End Shift",
        'period_start_label'=>"4:55pm",
        'period_end_label'=>"4:50am",
        'period_start'=>"1655",
        'period_end'=>"1705"
    ),

    array(
        'period_label'=>"After Shift",
        'period_start_label'=>"5:30pm",
        'period_end_label'=>"4:50am",
        'period_start'=>"1730",
        'period_end'=>"1750"
    ),
);


//print_r($camera);


//$camera_status=array("camera")



// names of files to ignore file searching

// under construction 



error_reporting(0);


?>
