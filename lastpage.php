<?php require_once("config.php"); ?>


<?php require_once("partials/nav.php"); ?>
<div class="container">
    <div class="row">
        <?php
        $condition = "green";

        function get_date_list($cam_name, $file_path)
        {

            $new_path = $file_path . $cam_name . "/";
            $scanned_directory = glob("$new_path**", GLOB_ONLYDIR);
            sort($scanned_directory);
            rsort($scanned_directory);
            return $scanned_directory;
        }
        function get_other_mp4($camera_name, $file_path, $date)
        {
            $new_path = $file_path . $camera_name . "/";

            $today_dir = $date;
            $new_new_path = $new_path . $today_dir . "/";
            $mp4_folder = array_diff(scandir($new_new_path, 1), array('..', '.'));
            $mp4_file_name = "No File";

            if ($handle = opendir($new_new_path)) {

                while (false !== ($entry = readdir($handle))) {
                    if (preg_match('/\.mp4$/', $entry)) {
                        $mp4_file_name = $entry;
                    }
                }

                closedir($handle);
            }
            $mp4_file_full_url = $new_new_path . $mp4_file_name;

            return $mp4_file_full_url;
        }

        function get_yesterday_mp4($camera_name, $file_path)
        {
            $yesterday_date = date('Ymd', strtotime("-1 days"));
            $mp4_url = $camera_name . "_" . $yesterday_date . ".mp4";
            return $file_path . $camera_name . "/" . $yesterday_date . "/" . $mp4_url;
        }

        function get_today_mp4($camera_name, $file_path)
        {
            $today_date = date('Ymd', strtotime("today"));
            $mp4_url = $camera_name . "_" . $today_date . ".mp4";
            return $file_path . $camera_name . "/" . $today_date . "/" . $mp4_url;
        }

        function humanTiming($time)
        {

            $time = time() - $time; // to get the time since that moment

            $tokens = array(
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );

            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
            }

        }

        function get_camera_last_image($camera_name, $file_path)
        {
            $folder_name = $camera_name;
            $camera_path = $file_path . $folder_name;
            $scanned_directory = glob("$camera_path/**", GLOB_ONLYDIR);
            sort($scanned_directory);
            rsort($scanned_directory);

            $path_to_photos = $scanned_directory[0];
            $avi_file_name = $camera_name . "_" . $scanned_directory[0] . ".avi";
            $mp4_file = $camera_name . "_" . $scanned_directory[0] . ".mp4";
            $images_array = glob($path_to_photos . '/*.jpg');

            sort($images_array);
            rsort($images_array);
            $i_count = count($images_array);

//print_r($images_array);
            $last_img_name = "";
            for ($i = 0; $i < 100; $i++) {


                if ($images_array[$i] !== NULL AND $images_array[$i] !== $avi_file_name AND $images_array[$i] !== $mp4_file) {
                    $last_img_name = $images_array[$i];
//echo $images_array[$i];
                    break;
                }
            }

            return $last_img_name;

        }

        function last_still($camera_name, $file_path)
        {

            $folder_name = $camera_name;
            $camera_path = $file_path . $folder_name;
            $scanned_directory = array_diff(scandir($camera_path, 1), array('..', '.', 'test'));

            if ($scanned_directory[0] == "" OR $scanned_directory[0] == NULL) {
                $scanned_directory[0] = $scanned_directory[1];

            }


            $path_to_photos = $camera_path . "/" . $scanned_directory[0];
            $images_array = glob($path_to_photos . '/*.jpg');
            sort($images_array);
            rsort($images_array);

            $i_count = count($images_array);

            $last_img_name = "";

            for ($i = 0; $i < 100; $i++) {


                if ($images_array[$i] !== NULL) {
                    $last_img_name = $images_array[$i];
//echo $images_array[$i];
                    break;
                }
            }

            $pieces = explode("_", $last_img_name);

            $time_period = $pieces[2];
            $year = substr($time_period, 0, 4);
            $month = substr($time_period, 4, 2);
            $day = substr($time_period, 6, 2);
            $hour = substr($time_period, 8, 2);
            $minute = substr($time_period, 10, 2);
            $test_date = "2015-05-10";

            $time_formatted = "2015-04-22 ";

//$time_in_12_hour_format  = date("g:i a", strtotime($time_formatted));
            $full_date_time = $year . "-" . $month . "-" . $day . " " . $time_formatted;

            $time_to_be_calculated = strtotime($year . "-" . $month . "-" . $day . $hour . ":" . $minute);

            $time_passed = humanTiming($time_to_be_calculated) . " ago";

            if ($time_passed == NULL) {
                $time_passed = "Just Now ";
            } elseif ($time_passed == "") {
                $time_passed = "Just Now ";
            } elseif ($time_passed == 0) {
                $time_passed = "Just Now ";
            }

            return $time_passed;
        }

        function get_camera_status($camera_name, $file_path)
        {

            $folder_name = $camera_name;
            $camera_path = $file_path . $folder_name;
            $scanned_directory = array_diff(scandir($camera_path, 1), array('..', '.', 'test'));

            if ($scanned_directory[0] == "" OR $scanned_directory[0] == NULL) {
                $scanned_directory[0] = $scanned_directory[1];

            }


            $path_to_photos = $camera_path . "/" . $scanned_directory[0];
            $images_array = glob($path_to_photos . '/*.jpg');
            sort($images_array);
            rsort($images_array);

            $i_count = count($images_array);

            $last_img_name = "";

            for ($i = 0; $i < 100; $i++) {


                if ($images_array[$i] !== NULL) {
                    $last_img_name = $images_array[$i];
//echo $images_array[$i];
                    break;
                }
            }

            $pieces = explode("_", $last_img_name);

            $time_period = $pieces[2];
            $year = substr($time_period, 0, 4);
            $month = substr($time_period, 4, 2);
            $day = substr($time_period, 6, 2);
            $hour = substr($time_period, 8, 2);
            $minute = substr($time_period, 10, 2);
            $test_date = "2015-05-10";

            $time_formatted = "2015-04-22 ";

//$time_in_12_hour_format  = date("g:i a", strtotime($time_formatted));
            $full_date_time = $year . "-" . $month . "-" . $day . " " . $time_formatted;

            $time_to_be_calculated = strtotime($year . "-" . $month . "-" . $day . $hour . ":" . $minute);

            $time_passed = humanTiming($time_to_be_calculated) . " ago";

            if ($time_passed == NULL) {
                $time_passed = "OK ";
            } elseif ($time_passed == "") {
                $time_passed = "Ok ";
            } elseif ($time_passed == 0) {
                $time_passed = "Ok ";
            } else{
                $time_passed = "Failed";
            }

            return $time_passed;
        }

        ?>

        <div class="col s12">
            <?php
            foreach ($camera as $myCam) {
                $cam_name = $myCam['camera_name'];
                $current_status = get_camera_status($cam_name, $file_path);
                if($current_status=="Failed"){
                    $condition = "red";
                    break;
                }
            }
            ?><h1>Condition <?php echo $condition; ?></h1>
            <table class="hoverable">
                <thead>
                <tr>
                    <th data-field="id">Camera Name</th>
                    <th data-field="id">Location</th>
                    <th data-field="name">
                        Most Recent File
                    </th>

                    <th data-field="name">
                        Status
                    </th>
                </tr>
                </thead>

                <tbody>
                <?php
                if (isset($_GET['camera'])) {
                    $maxCount = count($camera);

                    for ($i = 1; $i <= $maxCount; $i++) {
                        if ($camera[$i]['camera_name'] == $_GET['camera']) {

                        } else {
                            unset($camera[$i]);
                        }

                    }
                }
                $i = 1;
                foreach ($camera as $myCam) {
                $i++;

                $cam_name = $myCam['camera_name'];
                $ss = get_camera_last_image($cam_name, $file_path);

                $beg = $file_path . $cam_name . "/";
                $pic = explode($beg, $ss);
                $folder_name = explode("/", $pic[1]);
                $file_name = explode("_", $folder_name[1]);

                $h = substr($file_name[2], 8, 2);
                $m = substr($file_name[2], 10, 2);
                $d = substr($file_name[2], 0, 4) . "-" . substr($file_name[2], 4, 2) . "-" . substr($file_name[2], 6, 2);
                $link_url = "viewv2.php?single=1&date={$d}&hour={$h}&minute={$m}&cam_name={$cam_name}";
                $cam_width = $myCam['camera_thumb_width'];
                $cam_height = $myCam['camera_thumb_height'];
                $cam_location = $myCam['camera_location'];
                $cam_status = $myCam['camera_status'];
                $cam_res = $myCam['camera_res'];
                $cam_lip = $myCam['camera_ip'];
                $cam_intra = $myCam['camera_rtsp_loca'];
                $cam_ext = $myCam['camera_rtsp_internet'];
                $time_passed = last_still($cam_name, $file_path);
                $current_status = get_camera_status($cam_name, $file_path);
                $today = get_today_mp4($cam_name, $file_path);
                $yesterday = get_yesterday_mp4($cam_name, $file_path);
                $days_ago = date('Y-m-d');
                $cam_username = $myCam['camera_rtsp_username'];
                $cam_password = $myCam['camera_rtsp_password'];
                ?>
                <div class="camera-list">

                    <tr>
                        <td>  <?php echo $cam_name; ?></td>
                        <td> <?php echo $cam_location; ?></td>
                        <td> <?php echo $time_passed; ?></td>
                        <td> <?php echo $current_status; ?></td>

                    </tr>


                    <?php


                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
