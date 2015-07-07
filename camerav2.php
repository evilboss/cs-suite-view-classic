<?php require_once("config.php"); ?>


<?php require_once("partials/nav.php"); ?>
<div class="container">
    <div class="row">

        <?php
        function keytime($period)
        {

            $c = count($period);
            for ($i = 1; $i <= $c; $i++) {

                echo "<tr>";
                echo "<td>{$period[$i]['period_label']}</td>";
                echo "<td>{$period[$i]['period_start_label']}</td>";
                echo "<td>{$period[$i]['period_end_label']}</td>";
                echo "<td><a   target='_blank'  href='viewv2.php?period={$i}'> Frame by Frame</a></td>";
                echo "</tr>";


            }


        }

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

        ?>
        <div class="col s8">
            <?php

            for ($i = 1; $i <= count($camera); $i++) {
                $cam_name = $camera[$i]['camera_name'];
                $ss = get_camera_last_image($cam_name, $file_path);

                $beg = $file_path . $cam_name . "/";
                $pic = explode($beg, $ss);
                $folder_name = explode("/", $pic[1]);
                $file_name = explode("_", $folder_name[1]);

                $h = substr($file_name[2], 8, 2);
                $m = substr($file_name[2], 10, 2);
                $d = substr($file_name[2], 0, 4) . "-" . substr($file_name[2], 4, 2) . "-" . substr($file_name[2], 6, 2);
                $link_url = "viewv2.php?single=1&date={$d}&hour={$h}&minute={$m}&cam_name={$cam_name}";
                $cam_width = $camera[$i]['camera_thumb_width'];
                $cam_height = $camera[$i]['camera_thumb_height'];
                $cam_location = $camera[$i]['camera_location'];
                $cam_status = $camera[$i]['camera_status'];
                $cam_res = $camera[$i]['camera_res'];
                $cam_lip = $camera[$i]['camera_ip'];
                $cam_ext = $camera[$i]['camera_rtsp_internet'];
                $time_passed = last_still($cam_name, $file_path);
                $today = get_today_mp4($cam_name, $file_path);
                $yesterday = get_yesterday_mp4($cam_name, $file_path);
                $days_ago = date('Y-m-d');
                $cam_username=$camera[$i]['camera_rtsp_username'];
                $cam_password=$camera[$i]['camera_rtsp_password'];

                ?>
                <div class="camera-list">
                    <div class="card col s6">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator"
                                 src="<?php echo $ss; ?>">
                        </div>
                        <div class="card-content">
                    <span class="card-title activator grey-text text-darken-4"><?php echo $cam_name; ?>
                        <br><?php echo $time_passed; ?>
                        <i class="material-icons right">more_vert</i></span>

                            <p><a href='<?php echo $link_url; ?>'><i class="fa fa-camera fa-2x"></i></a>&nbsp;
                                <a href='<?php echo $cam_ext; ?>'><i class="fa fa-video-camera fa-2x"></i></a>&nbsp;
                                    <a target='_blank' href='<?php echo $today; ?>'><i class="fa fa-clock-o fa-2x"></i></a>
                            </p>
                        </div>
                        <div class="card-reveal" style="display: none; transform: translateY(0px);">
                            <span class="card-title grey-text text-darken-4">Camera Details<i
                                    class="material-icons right">close</i></span>

                            <div>
                                location: <?php echo $cam_location; ?>
                            </div>
                            <div>
                                Status: <?php echo $cam_status; ?>
                            </div>
                            <div>
                                Resolution: <?php echo $cam_res; ?>
                            </div>
                            <div>
                                IP: <?php echo $cam_lip; ?>
                            </div>

                            <div>
                                Live View: <a target='_blank'
                                                    href='viewv2.php?live=1&&rtsp=<?php echo $cam_ext; ?>&&cam_name=<?php echo $cam_name; ?>&&i=<?php echo $i; ?>'>Web</a>
                                | <a target='_blank' href='<?php echo $cam_ext; ?>'>App</a>
                            </div>
                            <div>
                                Username: <?php echo $cam_username; ?>
                            </div>
                            <div>
                                Password: <?php echo $cam_password; ?>
                            </div>
                            <div>
                                Playback:
                                <a target='_blank' href='<?php echo $today; ?>'>Today</a>|
                                <a target='_blank' href='<?php echo $yesterday; ?>'>Yesterday</a>
                            </div>
                            <div>
                                Snapshot: <div><a href='<?php echo $link_url; ?>'><i class="fa fa-camera fa-3x"></i></a></div>


                            </div>

                            <p>Here is some more information about this location that is only revealed once clicked
                                on.</p>
                        </div>
                    </div>
                </div>
                <?php


            }


            /*  echo "<td>Other</td>";
              for ($i = 1; $i <= count($camera); $i++) {
                  $cam_name = $camera[$i]['camera_name'];

                  $date_array = get_date_list($cam_name, $file_path);
                  $select_box = "";
                  for ($j = 0; $j < count($date_array); $j++) {
                      $exploded = $file_path . $cam_name . "/";
                      $formatted = explode($exploded, $date_array[$j]);

                      $date_y = substr($formatted[1], 0, 4);
                      $date_m = substr($formatted[1], 4, 2);
                      $date_d = substr($formatted[1], 6, 2);
                      $formatted_date = $date_y . "-" . $date_m . "-" . $date_d;
                      $non_formatted_date = $date_y . $date_m . $date_d;
                      $select_box .= "<option value='{$non_formatted_date}'>$formatted_date</option>";
                  }


                  echo "<td><form  target='_blank' action='view.php?download_mp4={$non_formatted_date}' method='get'><input type='hidden' name='cam_name' value='{$cam_name}'><select name='mp4_download'>$select_box</select> <br/><input type='submit' value='Download'></form></td>";
              }

              echo "</tr>";
              echo "<tr>";

              $ccc = count($camera) + 1;
              echo "<tr style='text-align:center;'>";*/


            ?>

        </div>
        <div class="col s4">
            <h2 class="blue-text text-darken-2">Bookmarks</h2>


            <table class="hoverable" border="1">
                <tr>
                    <td>Title</td>
                    <td>Start Time</td>
                    <td>End Time</td>
                    <td>Action</td>


                </tr>

                <?php keytime($period); ?>

        </div>
        <div class="col s3">


        </div>
    </div>
</div>
